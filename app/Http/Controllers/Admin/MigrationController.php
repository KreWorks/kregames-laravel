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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $migrationFolder = base_path()."/database/migrations";
        $files = scandir($migrationFolder);
        $files = array_diff(scandir($migrationFolder), array('.', '..')); 

        $migrations = $this->getAll();
        $batch = 1;
        if (count($migrations) < count($files)){
            foreach($migrations as $migration)
            {
                $batch = $migration->batch > $batch ? $migration->batch : $batch;
            }   
            $batch++;
            for($i = count($migrations); $i < count($files); $i++){
                $name = substr($files[$i+2], 0 ,-4);
                $className = str_replace('_', '',ucwords(substr($files[$i+2], 18), "_"));

                //$migrationFile = new $className();
                $alma = new \Database\Migrations\CreateLinktypesTable();
                $migration->up();
                /*$migration = Migration::create([
                    'migration' => $name,
                    'batch' => $batch
                ]);*/

            }
        }

        return redirect(route("admin.migrations.index"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $linktype = LinkType::find($id); 
            $linktype->update($this->getDataFromRequest($request));
            $linktype->save();
    
            return redirect(route("admin.linktypes.index"));

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
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
}
