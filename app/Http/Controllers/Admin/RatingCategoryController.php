<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RatingCategory;
use App\Models\JamRatingCategory;
use App\Models\Rating;
use App\Models\Jam;

class RatingCategoryController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Értékelési kategóriák';
        $this->_route = 'rating_categories';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rc = RatingCategory::create($this->getDataFromRequest($request));

        return redirect(route("admin.rating_categories.index"));
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
            $ratingCategory = RatingCategory::find($id);
            $ratingCategory->update($this->getDataFromRequest($request));

            return redirect(route("admin.rating_categories.index"));

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
        return RatingCategory::all();
    }

    protected function getEntity($id)
    {
        return RatingCategory::find($id);
    }

    protected function delete($id)
    {
        //Delete all the Ratings belong to this category
        $ratingIds = Rating::where(['rating_category_id' => $id])->delete();
        //Delete all the Jam connections
        $jamRatingIds = JamRatingCategory::where(['rating_category_id' => $id])->delete();
        
        RatingCategory::destroy($id);
    }
}
