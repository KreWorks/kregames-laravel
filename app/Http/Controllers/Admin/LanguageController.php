<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ResourceController;
use App\Models\Language;
use App\Models\Translation;

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
        $language = Language::create($this->getDataFromRequest($request));

        return redirect(route("admin.languages.index"))->with('success', 'Sikeres mentés.');
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
            $language = Language::find($id);
            $language->update($this->getDataFromRequest($request));

            return redirect(route("admin.languages.index"))->with('success', 'Sikeres mentés');

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
            'short' => $request->input('short'),
            'name' => $request->input('name'),
            'visible' => $request->input('visible') == null ? false : true
        ];
    }

    protected function getAll()
    {
        return Language::all();
    }

    protected function getEntity($id)
    {
        return Language::find($id);
    }

    protected function delete($id)
    {
        $deleteTranslationIds = Translation::where(['language_id' => $id])->delete();
        Language::destroy($id);
    }
}
