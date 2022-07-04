<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class IndexController extends Controller
{
    public function index()
    {
        $games = Game::where(['visible' => 1])->get();

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
        $games = Game::where(['visible' => 1])->get() ;

        $game = Game::where('slug', $slug)->first();

        return view('main.game', ['games' => $games, 'game' => $game]);
    }

    public function newGame($slug)
    {
        $games = Game::where(['visible' => 1])->get() ;
        $game = Game::where('slug', $slug)->first(); 

        return view('main.flex', ['games' => $games, 'game' => $game]);
    }

}
