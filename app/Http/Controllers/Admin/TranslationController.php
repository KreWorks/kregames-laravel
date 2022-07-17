<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translation;

class TranslationController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'fordítások';
        $this->_route = 'translations';
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
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translation $translation)
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
        return Translations::all();
    }

    protected function getExtraDatasForCreate()
    {
        return ['jams' => Jam::all()];
    }

    protected function getExtraDatasForUpdate()
    {
        return [
            'jams' => Jam::all(),
        ];
    }

    protected function getEntity($id)
    {
        return Translations::find($id);
    }

    protected function delete($id)
    {

    }
}
