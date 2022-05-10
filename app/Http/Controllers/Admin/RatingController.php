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

        if ($game->jam()->hasCategory($request->input('category_id')))
        {
            $game->ratings()->attach($request->input('category_id'), $this->getDataFromRequest($request));
        } 
        else 
        {
            
        }

        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
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
}
