<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class IndexController extends Controller
{
    public function index()
    {
        $games = Game::all();

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
