<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ResourceController;

use App\Models\Translation;
use App\Models\Contenttype; 
use App\Models\Language;

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
        $translation = Translation::create($this->getDataFromRequest($request));
        
        $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.translations.index");

        return redirect($redirectRoute)->with('success', 'Sikeres mentés.');;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $translation = Translation::find($id);
            if ($translation->game->id != $request->input('game_id') || $translation->category->id != $request->input('category_id')) {

                $rating->update($this->getDataFromRequest($request));
            }

            $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.translations.index");

            return redirect($redirectRoute)->with('success', 'Sikeres mentés.');;

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
            'language_id' => $request->input('language_id'),
            'contenttype_id' => $request->input('contenttype_id'),
            'translatable_type' => $request->input('translatable_type'),
            'translatable_id' => $request->input('translatable_id'), 
            'content' => $request->input('content')
        ];
    }

    protected function getAll()
    {
        return Translation::all();
    }

    protected function getExtraDatasForCreate()
    {
        return [
            'languages' => Language::where(['visible' => 1])->get(),
            'contenttypes' => Contenttype::all(), 
            'translatables' => Translation::getTranslatables()
        ];
    }

    protected function getExtraDatasForUpdate()
    {
        return [
            'languages' => Language::where(['visible' => 1])->get(),
            'contenttypes' => Contenttype::all(),
            'translatables' => Translation::getTranslatables()
        ];
    }

    protected function getEntity($id)
    {
        return Translation::find($id);
    }

    protected function delete($id)
    {
        Translation::destroy($id);
    }
}
