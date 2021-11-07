<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class IndexController extends Controller
{
    public function index()
    {
        echo 'hi Index';
        $games = Game::all();

        return view('main.index', ['games' => $games]);
    }
}
