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
        $clear = Artisan::call('view:clear');
        $refresh = Artisan::call('view::cache');
    }

    public function configrefresh()
    {
        $clear = Artisan::call('config:clear');
        $refresh = Artisan::call('config:cache');
    }

    public function migrate()
    {

    }

    public function seed()
    {

    }
}
