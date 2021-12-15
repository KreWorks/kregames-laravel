<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

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
                    'fa-icon' => 'fa-file-code-o',
                    'command' => 'storage',
                    'description' => 'Létrehozza a storage linkeket a public oldalra.',
                    'route' => 'storage',
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
                    'command' => 'migrate-status',
                    'description' => 'Visszaadja, hogy a migrácis scriptek milyen státuszban vannak.',
                    'route' => 'migratestatus',
                    'warningMsg' => '',
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
                    'warningMsg' => 'Töröl minden adatot az adatbázisból és a struktúra létrehozása után feltölti a seedelt adatokkal.',
                ], 
            ]
        ]; 

        return view('admin.artisan', $data);
    }   

    public function route()
    {
        return $this->runCommand('route:cache');
    }

    public function view()
    {
        return $this->runCommand('view:cache');
    }

    public function storage()
    {
        return $this->runCommand('storage:link');
    }

    public function config()
    {
        return $this->runCommand('config:cache');
    }

    public function migratestatus()
    {
        return $this->runCommand('migrate:status');
    }
    
    public function migrate()
    {
        return $this->runCommand('migrate');
    }

    public function reloaddb()
    {
        $return = $this->runCommand('migrate:reset');
        $return .= $this->runCommand('migrate');
        $return .= $this->runCommand('db:seed');

        return $return;
    }

    protected function runCommand($command)
    {
        Artisan::call($command); 
        return (Artisan::output());
    }
}
