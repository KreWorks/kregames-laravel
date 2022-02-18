<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Models\Link;
use App\Models\Linktype;
use App\Models\Game;
use App\Models\Jam;

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
            'linktypes' => Linktype::all(),
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

        if ($request->input('linktype_id')) {
            $linkType = Linktype::find($request->input('linktype_id'));
            $linkType->links()->save($link);
        }

        $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.links.index");
        
        return redirect($redirectRoute);
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
            $link = Link::find($id);
            $link->update($this->getDataFromRequest($request));

            if ($request->input('linktype_id')) {
                $linkType = Linktype::find($request->input('linktype_id'));
                $linkType->links()->save($link);
            }
    
            $redirectRoute = $request->input('redirect_route') != '' ? $request->input('redirect_route') : route("admin.links.index");

            return redirect($redirectRoute);

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
            'display_text' => $request->input('display_text'),
            'link' => $request->input('link'),
            'linkable_type' => $request->input('linkable_type'),
            'linkable_id' => $request->input('linkable_id'),
            'linktype_id' => $request->input('linktype_id')
        ];
    }

    protected function getAll()
    {
        return Link::all();
    }

    protected function getExtraDatas()
    {
        $linakbles = []; 
        foreach(Link::$morphs as $key => $class)
        {
            $linakbles[$key] = [
                'css-class' => strtolower($key), 
                'model' => $class,
                'items' => $class::all()
            ];
        }

        return [
            'linktypes' => Linktype::all(), 
            'morphs' => Link::$morphs, 
            'linkables' => $linakbles
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
