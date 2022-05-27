<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Models\Jam;
use App\Models\Image;
use App\Models\Link;

class JamController extends ResourceController
{
    use ImageTrait;

    protected $imageFolder = '/images/jams';
    
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Jam';
        $this->_route = 'jams';
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
        $this->handleImage($request, $jam);

        return redirect(route("admin.jams.index"));
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

            $this->handleImage($request, $jam);

            return redirect(route("admin.jams.index"));

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
            'entries' => $request->input('entries'),
            'theme' => $request->input('theme'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ];
    }

    protected function getAll()
    {
        return Jam::all();
    }
    protected function getEntity($id)
    {
        return Jam::find($id);
    }
    protected function delete($id)
    {
        $deletedImageIds = Image::where(['imageable_type' => Jam::class, 'imageable_id' => $id])->delete();
        $deletedLinkIds = Link::where(['linkable_type' => Jam::class, 'linkable_id' => $id])->delete();
        Jam::destroy($id);
    }

}
