<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Jam;

class CategoryController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Értékelési kategóriák';
        $this->_route = 'categories';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rc = Category::create($this->getDataFromRequest($request));

        return redirect(route("admin.categories.index"));
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
            $ratingCategory = Category::find($id);
            $ratingCategory->update($this->getDataFromRequest($request));

            return redirect(route("admin.categories.index"));

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
        }
    }


    protected function getDataFromRequest(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'fontawesome' => $request->input('fontawesome')
        ];
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

    protected function getAll()
    {
        return Category::all();
    }

    protected function getEntity($id)
    {
        return Category::find($id);
    }

    protected function delete($id)
    {
        //Delete all the Ratings belong to this category
        $ratingIds = Rating::where(['category_id' => $id])->delete();
        //Delete all the Jam connections
        /*$jamRatingIds = Category::belongsToMany(Role::class)
        ->wherePivot('approved', 1); CategoryJam::where(['category_id' => $id])->delete();*/
        
        RatingCategory::destroy($id);
    }
}
