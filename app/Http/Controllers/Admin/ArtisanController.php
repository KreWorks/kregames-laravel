<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;

class ArtisanController extends BaseController
{

    public function index()
    {
        $data = [
            'controller' => 'Artisan',
            'action' => 'Index'
        ]; 

        return view('admin.artisan', $data);
    }   

    public function routerefresh()
    {
        $refresh = Artisan::call('route:cache');
    }

    public function viewrefrest()
    {
        $refresh = Artisan::call('view::cache');
    }

    public function configrefresh()
    {
        $refresh = Artisan::call('config:cache');
    }

    public function migrate()
    {

    }

    public function seed()
    {

    }
}
