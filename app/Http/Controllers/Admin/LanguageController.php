<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'nyelvek';
        $this->_route = 'languages';
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
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
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
        return Languages::all();
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
        return Languages::find($id);
    }

    protected function delete($id)
    {

    }
}
