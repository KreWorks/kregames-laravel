<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Game; 
use App\Models\Jam;

class ImageController extends ResourceController
{
    public function __construct()
    {
        $this->_controller = 'Kép';
        $this->_route = 'images';
        $this->_name = 'kép';
        $this->_table = [ 
            'id' => 'id',
            'path' => 'Kép',
            'type' => 'típus', 
            'parent' => "szülő",
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
            'types' => Image::getImageTypeList(),
            'morphTypes' => Image::getMorphList(), 
            'morphs' => $this->getMorphs(),
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
            'types' => Image::getImageTypeList(),
            'morphTypes' => Image::getMorphList(),
            'morphs' => $this->getMorphs(),
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
        return Image::all();
    }
    protected function getEntity($id)
    {
        return Image::find($id);
    }
    protected function delete($id)
    {
        Image::destroy($id);
    }
    private function getMorphs()
    {
        return [
            'jams' => Jam::all(),
            'games' => Game::all()
        ];
    }
}
