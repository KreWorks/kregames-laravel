<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ResourceWithIconController;
use App\Models\Jam;
use App\Models\Image;

class JamController extends ResourceWithIconController
{
    public function __construct()
    {
        $this->_controller = 'Jam';
        $this->_route = 'jams';
        $this->_name = 'jam';
        $this->_table = [
            'iconPath' => 'icon', 
            'id' => 'id', 
            'name' => 'név', 
            'theme' => 'téma', 
            'entries' => 'versenyzők', 
            'start_date' => 'kezdés', 
            'end_date' => 'vég', 
            'duration' => 'hossz'
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jam = Jam::create($this->getDataFromRequest($request));

        if ($request->hasFile('icon')) {
            $this->storeIcon($request, $jam);
        }

        return redirect(route("admin.jams.index"));
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
            $jam = Jam::find($id); 
            $jam->update($this->getDataFromRequest($request));

            if ($request->hasFile('icon')) {
                $this->storeIcon($request, $jam);
            }
    
            return redirect(route("admin.jams.index"));

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
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'entries' => $request->input('entries'),
            'theme' => $request->input('theme'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ];
    } 

    protected function getAll()
    {
        return Jam::all();
    }
    protected function getEntity($id)
    {
        return Jam::find($id);
    }
    protected function delete($id)
    {
        $deletedIds = Image::where(['imageable_type' => Jam::class, 'imageable_id' => $id])->delete();
        Jam::destroy($id);
    }

}
