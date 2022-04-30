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
        $cj = CategoryJam::create($this->getDataFromRequest($request));
        
        $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.category_jam.index");
        
        return redirect($redirectRoute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getEntity($id);

        if ($request->input('redirect_route')){
            $jamId = $this->getJamId($request->input('redirect_route'));

            $entity = CategoryJam::where('jam_id', '=', $jamId)->where('category_id', '=', $id)->first();
        }
        
        $data = [
            'controller' => 'Jam',
            'action' => 'Szerkesztés',
            'entity' => $entity,
            'extraDatas' => $this->getExtraDatasForUpdate(),
            'redirectUrl' => $request->input('redirect_route'),
        ];

        return  view('admin.'.$this->_route.'.edit', $data);
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

            $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.category_jam.index");

            return redirect($redirectRoute);

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
        }
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
        if ($request->input('redirect_route_on_delete')) {
            $jamId = $this->getJamId($request->input('redirect_route_on_delete'));

            CategoryJam::where('jam_id', '=', $jamId)->where('category_id', '=', $id)->first()->delete();
        } else {
            $this->delete($id);
        }
        
        $redirect = route("admin.".$this->_route.".index");
        if($request->input('redirect_route_on_delete'))
        {
            $redirect = $request->input("redirect_route_on_delete");
        }

        return redirect($redirect);
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

    private function getJamId($redirectRoute) 
    {
        $jamId = preg_replace('/.+\/jams\//', "", $redirectRoute);
        $jamId = preg_replace('/\/edit/',"", $jamId);

        return $jamId;
    }

}
