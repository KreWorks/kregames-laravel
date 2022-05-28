<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\CategoryCheckerTrait;
use App\Models\CategoryJam;
use App\Models\Category;
use App\Models\Jam;

class CategoryJamController extends ResourceController
{
    use CategoryCheckerTrait;

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
        // TODO check if already exists
        $jam = Jam::find($request->input('jam_id'));
        if ($jam && $this->hasCategory($jam, $request->input('category_id'))) 
        {
            return redirect()->back()->with('error', 'Ez a kategória már hozzá van adva.');
        }

        $cj = CategoryJam::create($this->getDataFromRequest($request));
        
        $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.category_jam.index");
        
        return redirect($redirectRoute)->with('success', 'A kategória sikeresen hozzáadva.');
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

            if ($categoryJam->jam_id != $request->input('jam_id') || $categoryJam->category_id != $request->input('category_id')) 
            {
                $jam = Jam::find($request->input('jam_id'));
                if ($this->hasCategory($jam, $request->input('category_id')))
                {
                    return redirect()->back()->with('error', 'Ez a kategória már hozzá van adva.');
                } 
                else 
                {
                    $categoryJam->update($this->getDataFromRequest($request));
                }
            }

            $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.category_jam.index");

            return redirect($redirectRoute)->wwith('success', 'A kategória sikeresen frissítve.');

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
        if ($request->input('redirect_route_on_delete')) 
        {
            $jamId = $this->getJamId($request->input('redirect_route_on_delete'));

            CategoryJam::find($id)->delete();
        } else {
            $this->delete($id);
        }
        
        $redirect = route("admin.".$this->_route.".index");
        if($request->input('redirect_route_on_delete'))
        {
            $redirect = $request->input("redirect_route_on_delete");
        }

        return redirect($redirect)->with('success', 'Törlés sikeres');
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
        return CategoryJam::orderBy('jam_id', 'asc')->get();
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
