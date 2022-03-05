<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

abstract class ResourceController extends BaseController
{
    protected $_controller;
    protected $_route; //plural english name

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'controller' => $this->_controller,
            'action' => 'Lista',
            'datas' => $this->getAll(),
            'extraDatas' => $this->getExtraDatasForCreate(),
            'route' => $this->_route,
        ];

        return view('admin.'.$this->_route.'.list', $data);
    }

    /**
     * Return one entity
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = $this->getEntity($id);

        return $entity;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'controller' => $this->_controller,
            'action' => 'Létrehozás',
            'entity' => null,
            'extraDatas' => $this->getExtraDatasForCreate(),
            'redirectUrl' => $request->input('redirect_route'),
        ];

        return  view('admin.'.$this->_route.'.form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getEntity($id);

        $data = [
            'controller' => 'Jam',
            'action' => 'Szerkesztés',
            'entity' => $entity,
            'extraDatas' => $this->getExtraDatasForUpdate(),
            'redirectUrl' => $request->input('redirect_route'),
        ];

        if ($request->input('redirectRoute'))
        {
            return redirect($request->input('redirectRoute'));
        }
        else 
        {
            return  view('admin.'.$this->_route.'.edit', $data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->delete($id);

        $redirect = route("admin.".$this->_route.".index");
        if($request->input('redirect_route_on_delete'))
        {
            $redirect = $request->input("redirect_route_on_delete");
        }

        return redirect($redirect);
    }

    protected function getExtraDatasForCreate()
    {
        return [];
    }

    protected function getExtraDatasForUpdate()
    {
        return [];
    }
    /**
     * Create a data array from the request. Need to remove image content
     *
     * @param Request $request
     * @return Array $datas
     */
    abstract protected function getDataFromRequest(Request $request);
    abstract protected function getAll();
    abstract protected function getEntity($id);
    abstract protected function delete($id);
    private function storeIcon(Request $request, $parent)
    {
        $folder = 'images/jams';
        $filename = $request->input('slug') . "." . $request->icon->extension();
        $path = $request->icon->storeAs($folder, $filename);

        $imageData = [
            'type' => Image::ICON,
            'path' => $path
        ];

        if ($parent->icon == null) {
            $icon = $parent->icon()->create($imageData);
        } else {
            $icon = Image::where('id', $parent->icon->id)->update($imageData);
        }

    }
}
