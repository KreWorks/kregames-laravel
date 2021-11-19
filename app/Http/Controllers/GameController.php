<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ResourceWithIconController;
use App\Models\Game;
use App\Models\Image;
use App\Models\Jam;

class GameController extends ResourceWithIconController
{
    public function __construct()
    {
        $this->_controller = 'Játék';
        $this->_route = 'games';
        $this->_name = 'játék';
        $this->_table = [
            'iconPath' => 'icon', 
            'id' => 'id', 
            'name' => 'név', 
            'publish_date' => 'kiadási dátum'
        ];
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = Games::create($this->getDataFromRequest($request));

        if ($request->hasFile('icon')) {
            $this->storeIcon($request, $game);
        }

        return redirect(route("admin.games.index"));
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
        try
        {
            $game = Game::find($id); 
            $game->update($this->getDataFromRequest($request));

            if ($request->hasFile('icon')) {
                $this->storeIcon($request, $game);
            }
    
            return redirect(route("admin.games.index"));

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = $this->getEntity($id);

        $data = [
            'controller' => 'Jam',
            'action' => 'Szerkesztés',
            'entity' => $entity,
            'formAction' => 'admin.'.$this->_route.'.update',
            'jams' => Jam::all(),
        ];

        return  view('admin.'.$this->_route.'.form', $data);
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
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'entries' => $request->input('entries'),
            'theme' => $request->input('theme'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ];
    } 

    protected function getAll()
    {
        return Game::all();
    }
    protected function getEntity($id)
    {
        return Game::find($id);
    }
    protected function delete($id)
    {
        $deletedIds = Image::where(['imageable_type' => Game::class, 'imageable_id' => $id])->delete();
        Game::destroy($id);
    }
}
