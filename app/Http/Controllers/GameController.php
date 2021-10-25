<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
     /**
     * Execute an action on the controller.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function index()
    {
        return view('admin/index');
    }

    public function admin()
    {
        return view('admin/games/index');
    }
}
