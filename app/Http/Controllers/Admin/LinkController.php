<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Models\Link;
use App\Models\LinkType;

class LinkController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Link';
        $this->_route = 'links';
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
            'linktypes' => LinkType::all(),
            'extraDatas' => $this->getExtraDatas()
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
        $link = Link::create($this->getDataFromRequest($request));

        /*if ($request->input('linktype_id')) {
            $linkType = LinkType::find($request->input('linktype_id'));
            $linkType->games()->save($game);
        }*/


        return redirect(route("admin.links.index"));
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
            'controller' => 'Games',
            'action' => 'Szerkesztés',
            'entity' => $entity,
            'formAction' => 'admin.'.$this->_route.'.update',
            'jams' => Jam::all(),
            'extraDatas' => $this->getExtraDatas()
        ];

        return  view('admin.'.$this->_route.'.edit', $data);
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
            'link' => $request->input('slug'),
            'linktype_id' => auth()->user()->id
        ];
    }

    protected function getAll()
    {
        return Link::all();
    }

    protected function getExtraDatas()
    {
        return [
            'linktypes' => LinkType::all(),
            'morphTos' => Link::$morphsToClasses
        ];
    }

    protected function getEntity($id)
    {
        return Link::find($id);
    }
    protected function delete($id)
    {
        Link::destroy($id);
    }
}
