<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rating;
use App\Models\Game; 
use App\Models\Category;
use Illuminate\Http\Request;

class RatingController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Értékelés';
        $this->_route = 'ratings';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = Game::find($request->input('game_id'));

        if ($this->JamHasCategory($game->jam, $request->input('category_id')))
        {
            $game->ratings()->attach($request->input('category_id'), $this->getDataFromRequest($request));
        } 
        else 
        {
            throw Exception("Wrong category ");
        }

        return redirect(route("admin.ratings.index"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try
        {
            $rating = Rating::find($id);
            if ($rating->game->id != $request->input('game_id') || $rating->category->id != $request->input('category_id')) {

                $rating->update($this->getDataFromRequest($request));
            }

            $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.ratings.index");

            return redirect($redirectRoute);

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
        }
    }
    
    protected function getExtraDatasForCreate()
    {
        return [
            'games' => Game::all(),
            'categories' => Category::all()
        ];
    }

    protected function getExtraDatasForUpdate()
    {
        return [
            'games' => Game::all(),
            'categories' => Category::all()
        ];
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
            'rank' => $request->input('rank'),
            'average_point' => $request->input('average_point'),
            'rating_count' => $request->input('rating_count')
        ];
    }
    protected function getAll()
    {
        return Rating::all();
    }
    protected function getEntity($id)
    {
        return Rating::find($id);
    }
    protected function delete($id)
    {
        Rating::destroy($id);
    }

    protected function JamHasCategory($jam, $categoryId)
    {
        foreach($jam->categories as $category) 
        {
            if ($category->id == $categoryId)
            {
                return true;
            }
        }

        return false;
    }
}
