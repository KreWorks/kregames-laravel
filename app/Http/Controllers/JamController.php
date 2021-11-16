<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jam;
use App\Models\Image;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'controller' => 'Jam',
            'action' => 'Lista',
            'table' => [
                'iconPath' => 'icon', 
                'id' => 'id', 
                'name' => 'név', 
                'theme' => 'téma', 
                'entries' => 'versenyzők', 
                'start_date' => 'kezdés', 
                'end_date' => 'vég', 
                'duration' => 'hossz'
            ], 
            'datas' => Jam::all(),
            'editRoute' => 'admin.jams.edit',
            'destroyRoute' => 'admin.jams.destroy',
            'newRoute' => 'admin.jams.create',
            'newRouteText' => 'Új jam hozzáadása'
        ];

        return view('admin.jams.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'controller' => 'Jam',
            'action' => 'Létrehozás',
            'entity' => null
        ];

        return  view('admin.jams.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jam = Jam::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'entries' => $request->input('entries'),
            'theme' => $request->input('theme'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ]);

        if ($request->hasFile('icon')) {
            $folder = 'images/jams';
            $filename = $request->input('slug') . "." . $request->icon->extension();
            $path = $request->icon->storeAs($folder, $filename);

            $icon = $jam->icon()->create([
                'type' => Image::ICON, 
                'path' => $path
            ]);
        }

        return redirect(route("admin.jams.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
