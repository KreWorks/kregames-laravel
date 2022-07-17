<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenttype;

class ContenttypeController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'szöveg típusok';
        $this->_route = 'contenttypes';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contenttype  $contenttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contenttype $contenttype)
    {
        //
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
            'publish_date' => $request->input('publish_date'),
            'user_id' => auth()->user()->id, 
            'visible' => $request->input('visible') == null ? false : true
        ];
    }

    protected function getAll()
    {
        return Contenttype::all();
    }

    protected function getExtraDatasForCreate()
    {
        return ['jams' => Jam::all()];
    }

    protected function getExtraDatasForUpdate()
    {
        return [];
    }

    protected function getEntity($id)
    {
        return Contenttype::find($id);
    }

    protected function delete($id)
    {

    }
}
