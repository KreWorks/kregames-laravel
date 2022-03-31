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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $files = $this->getMigrationFiles();
        
        $migrations = $this->getAll();
        $batch = $this->getMaxBatch();
        if (count($migrations) < count($files)) {
            for ($i = count($migrations); $i < count($files); $i++) {
                $fileName = substr($files[$i], 0, -4);
                $this->runMigrationByFileName($fileName, $batch+1);
            }
        }

        return redirect(route("admin.migrations.index"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $fileName = $request->input("migration_file");
        $fileName = substr($fileName, 0, -4);
        
        $this->runMigrationByFileName($fileName);
        
        return redirect(route("admin.migrations.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $migration = Migration::find($id);
        
        $className = $migration->helperClassName;
        $className = "Database\\MigrationHelpers\\".$className;
        
        $className::dropIfExists();
        
        $migration->delete();
        
        return redirect(route("admin.".$this->_route.".index"));
    }

    protected function getMaxBatch()
    {
        return Migration::max('batch');
    }

    protected function runMigrationByFileName($fileName, $batch = null)
    {
        $migrationClass = Migration::GenerateHelperClassName($fileName);

        $migrationClass = "Database\\MigrationHelpers\\".$migrationClass;
        $migrationClass::createSchema();

        $batch = $batch == null ? $this->getMaxBatch() + 1 : $batch;
        
        $migration = Migration::create([
            'migration' => $fileName,
            'batch' => $batch
        ]);
        
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
            $files[] = $file;
        }
        //$files = array_diff(scandir($migrationFolder), array('.', '..')); 

        return $files;
    }
}
