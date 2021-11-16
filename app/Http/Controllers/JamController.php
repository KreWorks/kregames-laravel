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
            'entity' => null,
            'formAction' => 'admin.jams.store'
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
        $jam = Jam::create($this->getDataFromRequest($request));

        if ($request->hasFile('icon')) {
            $this->storeIcon($request, $jam);
        }

        return redirect(route("admin.jams.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jam = Jam::find($id);

        $data = [
            'controller' => 'Jam',
            'action' => 'Szerkesztés',
            'entity' => $jam,
            'formAction' => 'admin.jams.update'
        ];

        return  view('admin.jams.form', $data);
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
            $jam = Jam::find($id); 
            $jam->update($this->getDataFromRequest($request));

            if ($request->hasFile('icon')) {
                $this->storeIcon($request, $jam);
            }
    
            return redirect(route("admin.jams.index"));

        }catch(QueryException $ex) {
            return ['success'=>false, 'error'=>$ex->getMessage()];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedIds = Image::where(['imageable_type' => Jam::class, 'imageable_id' => $id])->delete();
        Jam::destroy($id);

        return redirect(route("admin.jams.index"));
    }

    /**
     * Create a data array from the request. Need to remove image content
     * 
     * @param Request $request
     * @return Array $datas
     */
    private function getDataFromRequest(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'entries' => $request->input('entries'),
            'theme' => $request->input('theme'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ];
    } 

    private function storeIcon(Request $request, $jam)
    {
        $folder = 'images/jams';
        $filename = $request->input('slug') . "." . $request->icon->extension();
        $path = $request->icon->storeAs($folder, $filename);

        $imageData = [
            'type' => Image::ICON, 
            'path' => $path
        ];

        if ($jam->icon == null) {
            $icon = $jam->icon()->create($imageData);
        } else {
            $icon = Image::where('id',$jam->icon->id)->update($imageData);
        }
        
    }
}
