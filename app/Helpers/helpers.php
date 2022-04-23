<?php
use Illuminate\Support\Facades\Route;

const MENUS = [
    [
        'name' => 'Dashboard',
        'route' => 'admin',
        'icon' => 'icon-home'
    ],
    [
        'name' => 'Jamek',
        'route' => 'admin.jams.index',
        'icon' => 'icon-award'
    ],
    [
        'name' => 'Értékelés kategóriák',
        'route' => 'admin.rating_categories.index',
        'icon' => 'icon-award'
    ],
    [
        'name' => 'Játékok',
        'route' => 'admin.games.index',
        'icon' => 'icon-compass'
    ],
    [
        'name' => 'Link típusok',
        'route' => 'admin.linktypes.index',
        'icon' => 'icon-link'
    ],
    [
        'name' => 'Linkek',
        'route' => 'admin.links.index',
        'icon' => 'icon-link'
    ],
    [
        'name' => 'Felhasználók',
        'route' => 'admin.users.index',
        'icon' => 'icon-user'
    ],
    [
        'name' => 'Migartions',
        'route' => 'admin.migrations.index',
        'icon' => 'icon-database'
    ]
];

if (!function_exists('get_menu')) {
    function get_menu()
    {
        $menus = MENUS;
        $current = get_current_route();
        foreach ($menus as $index => $menu) {

            $menus[$index]['isActive'] = $current === $menu['route'] ? 'active' : '';
            $menus[$index]['iconColor'] = $current === $menu['route'] ? 'card__icon--white' : 'card__icon--dark';
        }

        return $menus;
    }
}

if (!function_exists('get_current_route')) {
    function get_current_route()
    {
        return Route::currentRouteName();
    }
}

