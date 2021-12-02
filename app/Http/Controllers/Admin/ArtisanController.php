<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;

class ArtisanController extends BaseController
{
    public function index()
    {

    }

    public function routerefresh()
    {
        $clear = Artisan::call('route:clear');
        $refresh = Artisan::call('route:cache');
    }

    public function viewrefrest()
    {

    }

    public function configrefresh()
    {

    }

    public function migrate()
    {

    }
}
