<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Linktype;

class LinktypeController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Link típus';
        $this->_route = 'linktypes';
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $linkType = LinkType::create($this->getDataFromRequest($request));

        return redirect(route("admin.linktypes.index"));
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
            $linktype = LinkType::find($id); 
            $linktype->update($this->getDataFromRequest($request));
            $linktype->save();
    
            return redirect(route("admin.linktypes.index"));

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
            'fontawesome' => $request->input('fontawesome'),
            'color' => $request->input('color')
        ];
    } 

    protected function getAll()
    {
        return LinkType::all();
    }
    protected function getEntity($id)
    {
        return LinkType::find($id);
    }
    protected function delete($id)
    {
        $deletedLinkIds = Link::where(['linktype_id' => $id])->delete();
        Jam::destroy($id);
        LinkType::destroy($id);
    }
}
