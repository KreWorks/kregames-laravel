<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'controller' => 'Játék',
            'action' => 'Lista',
            'table' => [
                'iconPath' => 'icon', 
                'id' => 'id', 
                'name' => 'név', 
                'publish_date' => 'kiadási dátum'
            ], 
            'datas' => Game::all(),
            'routeName' => 'games',
            'newBtnText' => 'Új játék hozzáadása'
        ];

        return view('admin._layout.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'controller' => 'Játék',
            'action' => 'Létrehozás',
            'entity' => null,
            'formAction' => 'admin.games.store'
        ];

        return  view('admin.games.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'controller' => 'Játék',
            'action' => 'Létrehozás',
            'entity' => Game::find($id),
            'formAction' => 'admin.games.store'
        ];

        return  view('admin.games.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
