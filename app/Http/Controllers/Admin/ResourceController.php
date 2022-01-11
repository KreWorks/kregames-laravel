<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

abstract class ResourceController extends BaseController
{
    protected $_controller;
    protected $_route;
    protected $_name;
    protected $_table;

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
            'table' => $this->_table,
            'datas' => $this->getAll(),
            'routeName' => $this->_route,
            'newBtnText' => 'Új '.$this->_name.' hozzáadása'
        ];

        return view('admin.'.$this->_route.'.list', $data);
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
            'formAction' => 'admin.'.$this->_route.'.store'
        ];

        return  view('admin.'.$this->_route.'.form', $data);
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
            'formAction' => 'admin.'.$this->_route.'.update'
        ];

        return  view('admin.'.$this->_route.'.form', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->delete($id);

        return redirect(route("admin.".$this->_route.".index"));
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
