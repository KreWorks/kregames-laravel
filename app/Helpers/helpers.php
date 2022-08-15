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
        'icon' => 'icon-award',
        'sub' => [
            [
                'name' => 'Kategóriák',
                'route' => 'admin.categories.index',
                'icon' => 'icon-award'
            ],
            [
                'name' => 'Jam értékelési kategóriák',
                'route' => 'admin.category_jam.index',
                'icon' => 'icon-award'
            ]
        ]
    ],    
    [
        'name' => 'Játékok',
        'route' => 'admin.games.index',
        'icon' => 'icon-compass',
        'sub' => [
            [
                'name' => 'Értékelések',
                'route' => 'admin.ratings.index',
                'icon' => 'icon-award'
            ]
        ]
    ],   
    [
        'name' => 'Linkek',
        'route' => 'admin.links.index',
        'icon' => 'icon-link',
        'sub' => [
            [
                'name' => 'Link típusok',
                'route' => 'admin.linktypes.index',
                'icon' => 'icon-link'
            ]
        ]
    ],
    [
        'name' => 'Nyelvi tartalmak',
        'route' => 'admin.translations.index',
        'icon' => 'icon-flag',
        'sub' => [
            [
                'name' => 'Nyelvek',
                'route' => 'admin.languages.index',
                'icon' => 'icon-flag'
            ],
            [
                'name' => 'Tartalmi típusok',
                'route' => 'admin.contenttypes.index',
                'icon' => 'icon-file-text'
            ]
        ]
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
    ],
    [
        'name' => 'Seederek',
        'route' => 'admin.seeders.index',
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
            if (array_key_exists('sub', $menu)) 
            {
                foreach ($menu['sub'] as $subIndex => $subMenu) {
                    $menus[$index]['sub'][$subIndex]['isActive'] = $current === $subMenu['route'] ? 'active' : '';
                    $menus[$index]['sub'][$subIndex]['iconColor'] = $current === $subMenu['route'] ? 'card__icon--white' : 'card__icon--dark';
                }
            }
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

if (!function_exists('create_slug')) {
    function create_slug($name) 
    {
        $slug = strtolower($name);
        $toLine = ['/ /'];
        $toNothing = ['/\'/'];

        $slug = preg_replace($toLine, '-', $slug);
        $slug = preg_replace($toNothing, '', $slug);

        return $slug;
    }
}

