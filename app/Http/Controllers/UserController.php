<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ResourceWithIconController;
use App\Models\User;

class UserController extends ResourceWithIconController
{
    public function __construct()
    {
        $this->_controller = 'Felhasználó';
        $this->_route = 'users';
        $this->_name = 'felhasználó';
        $this->_table = [
            'avatarPath' => 'avatar', 
            'id' => 'id', 
            'name' => 'név',
            'email' => 'email'
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
        $user = Game::create($this->getDataFromRequest($request));

        $this->checkImage($request, $game);

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
        return User::all();
    }
    protected function getEntity($id)
    {
        return User::find($id);
    }
    protected function delete($id)
    {
        $deletedIds = Image::where(['imageable_type' => User::class, 'imageable_id' => $id])->delete();
        User::destroy($id);
    }

    protected function checkImage(Request $request, $user)
    {
        
        $file = new Filesystem();
        $folder = '/images/avatars';

        if (!$file->isDirectory(storage_path($folder))) {
            $file->makeDirectory(storage_path($folder), 755, true, true);
        } 

        if ($request->hasFile('icon')) {
            $filename = 'avatar_'.$user->id.'.' . $request->icon->extension();
            $this->storeIcon($request, $game, $folder, $filename);
        }
    }
}
