<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\MigrationTrait;
use App\Models\Migration;

class SeederController extends ResourceController
{
    use MigrationTrait;

    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Migration';
        $this->_route = 'seeder';
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = $this->getMigrationFiles(); 
        $migrations = $this->getAll();

        $datas = []; 
        foreach($migrations as $migration) {
            if (in_array($migration->migration, $files)){
                $datas[$migration->migration] = $migration;
            }
        }

        foreach($files as $file) {
            if (!array_key_exists($file, $datas)) {
                $datas[$file] = null;
            }
        }

        ksort($datas);

        $data = [
            'controller' => $this->_controller,
            'action' => 'Lista',
            'datas' => $datas,
            'extraDatas' => $this->getExtraDatasForCreate(),
            'route' => $this->_route, 
            'helper' => $this
        ];

        return view('admin.'.$this->_route.'.list', $data);
    }

    /**
     * It runs the migration up 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input("unstored")) {
            $files = $this->getMigrationFiles();
        
            $migrations = $this->getAll();
            $batch = $this->getMaxBatch();
            if (count($migrations) < count($files)) {
                for ($i = count($migrations); $i < count($files); $i++) {
                    $fileName = $files[$i];
                    $this->runMigrationByFileName($fileName, $batch+1);
                }
            }
        }
        else if ($request->input("migration_file")) {
            $fileName = $request->input("migration_file");
            
            $this->runMigrationByFileName($fileName);
        }

        return redirect(route("admin.migrations.index"));
    }

    /**
     * It runs all the migrations needed to run
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $fileName = $request->input("migration_file");
        
        $this->runMigrationByFileName($fileName);
        
        return redirect(route("admin.migrations.index"));
    }

    /**
     * It runs the seeder of a table (if exists)
     *
     * @param  int  $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->seedMigrationTableById($id);
        
        return  redirect(route('admin.migrations.index'));
    }

    /**
     * It removes the migration
     *
     * @param  int  $id
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $migration = Migration::find($id);

        $this->deleteEarlierMigrations($migration->batch);

        return redirect(route("admin.".$this->_route.".index"));
    }

    /** 
     * It run the user migration script but with the seeder, 
     * because admin could not be used without any use
     */
    public function userrebuild()
    {
        $files = $this->getMigrationFiles();
        $userMigrationFiles = [];
        $smallestBatch = 100;
        foreach($files as $file) {
            if(preg_match('/users/', $file)) {
                $type = $this->GetType($file);
                $userMigrationFiles[$type][] = $file;
                $migration = Migration::where('migration', '=', $file)->first();
                $smallestBatch = $smallestBatch > $migration->batch ? $migration->batch : $smallestBatch;
                if ($migration)
                {
                    $this->dropMigrationById($migration->id);
                }
            }
        }

        $this->deleteEarlierMigrations($smallestBatch);
        $this->runMigrationByFileName($userMigrationFiles['create'][0]);
        
        if (array_key_exists('update', $userMigrationFiles)) {
            foreach($userMigrationFiles['update'] as $file) {
                $this->runMigrationByFileName($file);
            }
        }

        $createMigration = Migration::where('migration', '=', $userMigrationFiles['create'][0])->first();

        $this->runSeederByClassName('LinktypeSeeder');
        $this->seedMigrationTableById($createMigration->id);
        
        return redirect(route("admin.".$this->_route.".index"));
    }

    protected function deleteEarlierMigrations($batch)
    {
        $migrations = Migration::where('batch', ">=", $batch)->orderBy('batch', 'desc')->get();

        if ($migrations->count() > 0) 
        {
            foreach($migrations as $migr) 
            {
                $this->dropMigrationById($migr->id);
            }
        }
    }

    protected function getMaxBatch()
    {
        return Migration::max('batch');
    }

    protected function runMigrationByFileName($fileName, $batch = null)
    {
        $migrationClass = $this->GenerateHelperClassName($fileName);

        $migrationClass =   $migrationClass;
        $type = $this->GetType($fileName);

        if ($type == 'create') 
        {
            $migrationClass::runMigration();
        } 
        else 
        {
            $index = $this->GetUpdateNumber($fileName);
            $migrationClass::update($index);
        }

        $batch = $batch == null ? $this->getMaxBatch() + 1 : $batch;
        
        $migration = Migration::create([
            'migration' => $fileName,
            'batch' => $batch
        ]);
        
    }

    protected function dropMigrationById($id)
    {
        $migration = Migration::find($id);
        
        $migrationClass = $migration->helperClassName;
        $fileName = $migration->migration;

        $type = $this->GetType($fileName);

        if ($type == 'create') 
        {
            $migrationClass::dropIfExists();
        } 
        else 
        {
            $index = $this->GetUpdateNumber($fileName);
            $migrationClass::downGrade($index);
        }
        
        $migration->delete();
    }

    protected function seedMigrationTableById($id)
    {
        $entity = $this->getEntity($id);
        if ($entity->hasSeeder())
        {
            $this->runSeederByClassName($entity->getSeederClass());
        }
    }

    protected function runSeederByClassName($className)
    {
        $seeder = new $className();
        $seeder->run();
    }

    /**
     * Create a data array from the request. Need to remove image content
     * 
     * @param Request $request
     * @return Array $datas
     */
    protected function getDataFromRequest(Request $request)
    {
        return [
            'migration' => $request->input('migration'),
            'batch' => $request->input('batch')
        ];
    } 

    protected function getAll()
    {
        return Migration::all();
    }
    protected function getEntity($id)
    {
        return Migration::find($id);
    }
    protected function delete($id)
    {
        Migration::destroy($id);
    }

    private function getMigrationFiles()
    {
        $migrationFolder = base_path()."/database/migrations";
        $allFiles = scandir($migrationFolder);
        $files = [];
        foreach($allFiles as $file) {
            if ($file == '.' || $file == '..'){
                continue; 
            }
            //Removes extension
            $files[] = substr($file, 0, -4);
        }

        return $files;
    }
}
