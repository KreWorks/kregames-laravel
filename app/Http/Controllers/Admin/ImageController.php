<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Traits\ImageTrait;
use App\Models\Image;
use App\Models\Game;
use App\Models\Jam;

class ImageController extends ResourceController
{
    use ImageTrait;

    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Kép';
        $this->_route = 'images';
        $this->_name = 'kép';
        $this->_tableLabels = [
            'id' => 'id',
            'path' => 'Kép',
            'type' => 'típus',
            'parent' => "szülő",
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
        $game = Game::find($request->input("imageable_id"));

        $this->handleImage($request, $game);

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
            'title' => $request->input('title'),
        ];
    }

    protected function checkImage(Request $request, $game)
    {
        $file = new Filesystem();
        $folder = $game->imageFolder;

        if (!$file->isDirectory(storage_path($folder))) {
            $file->makeDirectory(storage_path($folder), 755, true, true);
        }

        if ($request->hasFile('image')) {
            $filename = 'image.' . $request->image->extension();
            $this->storeIcon($request, $game, $filename, $game->title." image");
        }
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
}
