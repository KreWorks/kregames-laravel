<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Image;
use App\Models\Link;

class UserController extends ResourceWithIconController
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Felhasználó';
        $this->_route = 'users';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($this->getDataFromRequest($request));

        $this->checkImage($request, $user);

        return redirect(route("admin.users.index"));
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
            $user = User::find($id);
            $user->update($this->getDataFromRequest($request));

            $this->checkImage($request, $user);

            return redirect(route("admin.users.index"));

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
        $data = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email')
        ];

        if ($request->has('password') && $request->input('password') != '') {
            $data['password'] = Hash::make($request->input('password'));
        }

        return $data;
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
        $deletedImageIds = Image::where(['imageable_type' => User::class, 'imageable_id' => $id])->delete();
        $deletedLinkIds = Link::where(['linkable_type' => User::class, 'linkable_id' => $id])->delete();
        User::destroy($id);
    }

    protected function checkImage(Request $request, $user)
    {

        $file = new Filesystem();
        $folder = '/images/avatars';

        if (!$file->isDirectory(storage_path($folder))) {
            $file->makeDirectory(storage_path($folder), 755, true, true);
        }

        if ($request->hasFile('avatar')) {
            $filename = 'avatar_'.$user->id.'.' . $request->avatar->extension();
            $this->storeIcon($request, $user, $folder, $filename);
        }
    }

    protected function storeIcon(Request $request, $parent, $folder, $filename)
    {
        $path = $request->avatar->storeAs($folder, $filename);

        $imageData = [
            'type' => Image::ICON,
            'path' => $path
        ];

        if ($parent->avatar == null) {
            $avatar = $parent->avatar()->create($imageData);
        } else {
            $avatar = Image::where('id', $parent->avatar->id)->update($imageData);
        }
    }
}
