<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;    

class IndexController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        $games = Game::where("user_id", 1)->get(); 

        return view('main.index', ['games' => $games]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function game($slug)
    {
        $games = Game::all();
        $game = Game::where('slug', $slug)->first();

        return view('main.game', ['games' => $games, 'game' => $game]);
    }

}
