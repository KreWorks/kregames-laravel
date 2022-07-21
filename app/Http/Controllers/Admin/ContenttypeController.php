<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ResourceController;
use App\Models\Contenttype;
use App\Models\Translation;

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
        $contenttype = Contenttype::create($this->getDataFromRequest($request));

        return redirect(route("admin.contenttypes.index"))->with('success', 'Sikeres mentés.');
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
            $contenttype = Contenttype::find($id);
            $contenttype->update($this->getDataFromRequest($request));

            return redirect(route("admin.contenttypes.index"))->with('success', 'Sikeres mentés');

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
            'model' => $request->input('model'),
            'name' => $request->input('name'),
        ];
    }

    protected function getAll()
    {
        return Contenttype::all();
    }

    protected function getExtraDatasForCreate()
    {
        return ['types' => Contenttype::$modelTypes];
    }

    protected function getExtraDatasForUpdate()
    {
        return ['types' => Contenttype::$modelTypes];
    }

    protected function getEntity($id)
    {
        return Contenttype::find($id);
    }

    protected function delete($id)
    {
        $deleteTranslationIds = Translation::where(['contenttype_id' => $id])->delete();
        Contenttype::destroy($id);
    }
}
