<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
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
            'jamName' => "Jam",
            'publish_date' => 'kiadási dátum'
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'controller' => $this->_controller,
            'action' => 'Létrehozás',
            'entity' => null,
            'formAction' => 'admin.'.$this->_route.'.store',
            'jams' => Jam::all()
        ];

        return  view('admin.'.$this->_route.'.form', $data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = Game::create($this->getDataFromRequest($request));

        if ($request->input('jam_id')) {
            $jam = Jam::find($request->input('jam_id'));
            $jam->games()->save($game);
        }

        $this->checkImage($request, $game);

        return redirect(route("admin.games.index"));
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

            if ($request->input('jam_id') && $request->input('jam_id') != 0) {
                $jam = Jam::find($request->input('jam_id'));
                $jam->games()->save($game);
            } else {
                $game->jam_id = null;
                $game->save();
            }

            $this->checkImage($request, $game);
    
            return redirect(route("admin.games.index"));

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
        }
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
            'publish_date' => $request->input('publish_date')
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

    protected function checkImage(Request $request, $game)
    {
        
        $file = new Filesystem();
        $folder = '/images/games/'.$game->slug;

        if (!$file->isDirectory(storage_path($folder))) {
            $file->makeDirectory(storage_path($folder), 755, true, true);
        } 

        if ($request->hasFile('icon')) {
            $filename = 'icon.' . $request->icon->extension();
            $this->storeIcon($request, $game, $folder, $filename);
        }
    }
}
