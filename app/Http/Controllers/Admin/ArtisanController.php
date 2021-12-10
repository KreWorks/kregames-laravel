<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;

class ArtisanController extends BaseController
{

    public function index()
    {
        $data = [
            'controller' => 'Artisan',
            'action' => 'Index',
            'commands' =>[
                [
                    'fa-icon' => 'fa-file-code-o',
                    'command' => 'route',
                    'description' => 'Ismételten felolvassa a routes mappa tartalmát, és frissíti a routing-ot, egy route::clear, és egy route::cache történik.',
                    'route' => 'route',
                    'warningMsg' => '',
                ], 
                [
                    'fa-icon' => 'fa-file-code-o',
                    'command' => 'view',
                    'description' => 'Frissíti a blade templatekből generált view-kat. Szintén clear és cache parancsok kerülnek futtatásra.',
                    'route' => 'view',
                    'warningMsg' => '',
                ], 
                [
                    'fa-icon' => 'fa-cog',
                    'command' => 'config',
                    'description' => 'Frissíti a config leírókat. Akkor szükséges, ha valamilyen változás történik a hozzáférésekben, elérési utakban.',
                    'route' => 'config',
                    'warningMsg' => 'Esetleges problémát okozhat adatbázis elérésben vagy egyéb meghatározásokban.',
                ], 
                [
                    'fa-icon' => 'fa-database',
                    'command' => 'migrate',
                    'description' => 'Futtatja azokat a migárciókat, amelyek még nem voltak futtatva. Mindezt a migrate táblában tárolja el. Ha frissül az adatbázis séma, akkor szükséges.',
                    'route' => 'migrate',
                    'warningMsg' => '',
                ], 
                [
                    'fa-icon' => 'fa-database',
                    'command' => 'reload DB',
                    'description' => 'Eldobja a jelenlegi adatbázist, és újra visszatölti a szerkezetét. Fontos, hogy csak a szerkezetét tölti vissza. Minden adat elvész ennek a futtatásakor.',
                    'route' => 'reloaddb',
                    'warningMsg' => 'Töröl minden adatot az adatbázisból és egy üres struktúrát hoz létre.',
                ], 
                [
                    'fa-icon' => 'fa-database',
                    'command' => 'seed DB',
                    'description' => 'Feltölti az adatbázist azzal a tartalommal, ami a seederekben van beírva. Ha az adatbázis eldobása nélkül futtatjuk, akkor hibára fut, a unique mezők miatt. (Pl user esetén az email).',
                    'route' => 'seed',
                    'warningMsg' => 'Hibára fut, ha nem üres állapotába van az adatbázis (egyedi kulcsok miatt).',
                ], 
            ]
        ]; 

        return view('admin.artisan', $data);
    }   

    public function route()
    {
        return Artisan::call('route:cache');
    }

    public function view()
    {
        return Artisan::call('view:cache');
    }

    public function config()
    {
        return Artisan::call('config:cache');
    }

    public function migrate()
    {
        return Artisan::call('migrate');
    }

    public function reloaddb()
    {
        $return = Artisan::call('migrate:rollback');
        $return .= Artisan::call('migrate');

        return $return;
    }

    public function seed()
    {
       return Artisan::call('db:seed');
    }
}
