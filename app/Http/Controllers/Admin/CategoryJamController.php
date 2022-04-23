<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryJam;
use App\Models\RatingCategory;
use App\Models\Category;
use App\Models\Jam;
use Illuminate\Http\Request;

class CategoryJamController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Jam értékelés kategóriák';
        $this->_route = 'category_jam';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CategoryJam::create($this->getDataFromRequest($request));

        return redirect(route("admin.category_jam.index"));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try
        {
            $categoryJam = CategoryJam::find($id);
            if ($categoryJam->jam_id != $request->input('jam_id') || $categoryJam->category_id != $request->input('category_id')) {

                $categoryJam->update($this->getDataFromRequest($request));
            }

            return redirect(route("admin.category_jam.index"));

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
        }
    }

    protected function getDataFromRequest(Request $request)
    {
        return [
            'jam_id' => $request->input('jam_id'),
            'category_id' => $request->input('category_id'),
        ];
    }
    protected function getExtraDatasForCreate()
    {
        return [
            'jams' => Jam::all(),
            'categories' => Category::all()
        ];
    }

    protected function getExtraDatasForUpdate()
    {
        return [
            'jams' => Jam::all(),
            'categories' => Category::all()
        ];
    }

    protected function getAll()
    {
        return CategoryJam::all();
    }

    protected function getEntity($id)
    {
        return CategoryJam::find($id);
    }

    protected function delete($id)
    {       
        CategoryJam::destroy($id);
    }

}
