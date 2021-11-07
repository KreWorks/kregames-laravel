<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Jam; 
use App\Models\Game;

class GameSeeder extends Seeder
{
    const GAME_DATAS = [
        [
            'game' => [
                'id' => 1, 
                'name' => 'One True Pairing',
                'slug' => 'one-true-pairing',
                'publish_date' => '2019-02-23 08:12:00', 
                //'jam_id' => 1
            ],
            'game_icon' => [
                'id' => 1, 
                'type' => Image::ICON, 
                /*'imageable_id' => 1, 
                'imageable_type' => App\Models\Game::class, */
                'path' => "one-true-pairing\icon.png"
            ], 
            'jam' => [
                'id' => 1,
                'name' => "Brackey's Game jam #2",
                'slug' => "brackeys-2",
                'entries' => 318,
                'theme' => "Love is blind",
                'start_date' => "2019-02-16 09:00:00",
                'end_date' => "2019-02-23 09:00:00"
            ],
            'jam_icon' => [
                'id' => 2, 
                'type' => Image::ICON, 
                /*'imageable_id' => 1, 
                'imageable_type' => App\Models\Jam::class,*/
                'path' => "brackeys-2.jpg"
            ]
        ], 
        [
            'game' => [
                'id' => 2, 
                'name' => 'Dark Liquid Company',
                'slug' => 'dark-liquid-company',
                'publish_date' => '2019-03-24 14:26:00', 
                //'jam_id' => 2
            ],
            'game_icon' => [
                'id' => 3, 
                'type' => Image::ICON, 
               /* 'imageable_id' => 2, 
                'imageable_type' => App\Models\Game::class, */
                'path' => "dark-liquid-company\icon.png"
            ], 
            'jam' => [
                'id' => 2,
                'name' => "Pizza Jam",
                'slug' => "pizza-jam",
                'entries' => 53,
                'theme' => "I am the strongest!",
                'start_date' => "2019-03-22 19:00:00",
                'end_date' => "2019-03-24 19:00:00"
            ],
            'jam_icon' => [
                'id' => 4, 
                'type' => Image::ICON, 
                /*'imageable_id' => 2, 
                'imageable_type' => App\Models\Jam::class,*/
                'path' => "pizza-jam.jpg"
            ]
        ],
        [
            'game' => [
                'id' => 3, 
                'name' => 'Escape from the bank',
                'slug' => 'escape-from-the-bank',
                'publish_date' => '2019-04-29 20:42:00', 
                //'jam_id' => 3
            ],
            'game_icon' => [
                'id' => 5, 
                'type' => Image::ICON, 
               /* 'imageable_id' => 3, 
                'imageable_type' => App\Models\Game::class, */
                'path' => "escape-from-the-bsnk\icon.png"
            ], 
            'jam' => [
                'id' => 3,
                'name' => "Ludum Dare 44",
                'slug' => "ludum-dare-44",
                'entries' => 2538,
                'theme' => "Your life is currency",
                'start_date' => "2019-04-27 03:00:00",
                'end_date' => "2019-04-30 03:00:00"
            ],
            'jam_icon' => [
                'id' => 6, 
                'type' => Image::ICON, 
                /*'imageable_id' => 3, 
                'imageable_type' => App\Models\Jam::class,*/
                'path' => "ludum-dare-44.jpg"
            ]
        ], 
        [
            'game' => [
                'id' => 4, 
                'name' => 'Pothole panic',
                'slug' => 'pothole-panic',
                'publish_date' => '2020-02-22 15:51:00', 
                //'jam_id' => 2
            ],
            'game_icon' => [
                'id' => 7, 
                'type' => Image::ICON, 
                /*'imageable_id' => 4, 
                'imageable_type' => App\Models\Game::class, */
                'path' => "pothole-panic\icon.png"
            ], 
            'jam' => [
                'id' => 4,
                'name' => "Brackeys Game Jam 2020.1",
                'slug' => "brackeys-3",
                'entries' => 700,
                'theme' => "Holes",
                'start_date' => "2020-02-16 09:00:00",
                'end_date' => "2020-02-23 09:00:00"
            ],
            'jam_icon' => [
                'id' => 8, 
                'type' => Image::ICON, 
                /*'imageable_id' => 4, 
                'imageable_type' => App\Models\Jam::class,*/
                'path' => "brackeys-3.jpg"
            ]
        ], 
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::GAME_DATAS as $data) {
            $jam = Jam::create($data['jam']);
            //$jam->icon()->create([$data['jam_icon']]);
            $game = Game::create([$data['game']]);
            $game->jam = $jam;
            $game->images()->create([$data['game_icon']]);
            /*
            $jamIcon = Image::create($data['jam_icon']);
            $data['game']['jam_id'] = $jam->id;
            $game = Game::create($data['game']);
            $gameIcon = Image
            echo '1 missisippi';
            DB::table('jams')->insert($data['jam']);
            DB::table('images')->insert($data['jam_icon']);
            DB::table('games')->insert($data['game']);
            DB::table('images')->insert($data['game_icon']);*/

            /*$flight = Flight::create([
                'name' => 'London to Paris',
            ])*/
        }
        /*
        DB::table('jams')->insert([
            'id' => 1,
            'name' => "Brackey's Game jam #2",
            'slug' => "brackeys-2",
            'entries' => 318,
            'theme' => "Love is blind",
            'start_date' => "2019-02-16 09:00:00",
            'end_date' => "2019-02-23 09:00:00"
        ]); 
        DB::table('images')->insert([
            'id' => 1, 
            'type' => Image::ICON, 
            'imageable_id' => 1, 
            'imageable_type' => App\Models\Jam::class,
            'path' => "brackeys-2.jpg"
        ]);
        DB::table('games')->insert([
            'id' => 1, 
            'name' => 'One True Pairing',
            'slug' => 'one-true-pairing',
            'published_date' => '2019-02-23 08:12:00', 
            'jam_id' => 1
        ]);
        DB::table('images')->insert([
            'id' => 2, 
            'type' => Image::ICON, 
            'imageable_id' => 1, 
            'imageable_type' => App\Models\Games::class, 
            'path' => "brackeys-2\icon.png"
        ]);
        */
    }
}
