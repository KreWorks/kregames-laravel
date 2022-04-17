<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Migration;

class MigrationController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Migration';
        $this->_route = 'migrations';
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'controller' => $this->_controller,
            'action' => 'Lista',
            'datas' => $this->getAll(),
            'extraDatas' => $this->getExtraDatasForCreate(),
            'route' => $this->_route,
            'files' => $this->getMigrationFiles()
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
        $this->dropMigrationById($id);
        
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
        foreach($files as $file) {
            if(preg_match('/users/', $file)) {
                $type = Migration::GetType($file);
                $userMigrationFiles[$type][] = $file;
                $migration = Migration::where('migration', '=', $file)->first();
                if ($migration)
                {
                    $this->dropMigrationById($migration->id);
                }
            }
        }

        $this->runMigrationByFileName($userMigrationFiles['create'][0]);
        
        if (array_key_exists('update', $userMigrationFiles)) {
            foreach($userMigrationFiles['update'] as $file) {
                $this->runMigrationByFileName($file);
            }
        }

        $createMigration = Migration::where('migration', '=', $userMigrationFiles['create'][0])->first();

        $this->seedMigrationTableById($createMigration->id);
        
        return redirect(route("admin.".$this->_route.".index"));
    }

    protected function getMaxBatch()
    {
        return Migration::max('batch');
    }

    protected function runMigrationByFileName($fileName, $batch = null)
    {
        $migrationClass = Migration::GenerateHelperClassName($fileName);

        $migrationClass =   $migrationClass;
        $migrationClass::createSchema();

        $batch = $batch == null ? $this->getMaxBatch() + 1 : $batch;
        
        $migration = Migration::create([
            'migration' => $fileName,
            'batch' => $batch
        ]);
        
    }

    protected function dropMigrationById($id)
    {
        $migration = Migration::find($id);
        
        $className = $migration->helperClassName;
        
        $className::dropIfExists();
        
        $migration->delete();
    }

    protected function seedMigrationTableById($id)
    {
        $entity = $this->getEntity($id);
        if ($entity->hasSeeder())
        {
            $className = $entity->getSeederClass();
            $seeder = new $className();
            $seeder->run();
        }
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
