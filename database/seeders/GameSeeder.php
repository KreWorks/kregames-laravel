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
                'name' => 'One True Pairing',
                'slug' => 'one-true-pairing',
                'publish_date' => '2019-02-23 08:12:00', 
                'user_id' => 1,
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "one-true-pairing\icon.png"
            ], 
            'jam' => [
                'name' => "Brackey's Game jam #2",
                'slug' => "brackeys-2",
                'entries' => 318,
                'theme' => "Love is blind",
                'start_date' => "2019-02-16 09:00:00",
                'end_date' => "2019-02-23 09:00:00"
            ],
            'jam_icon' => [
                'type' => Image::ICON, 
                'path' => "brackeys-2.jpg"
            ]
        ], 
        [
            'game' => [
                'name' => 'Dark Liquid Company',
                'slug' => 'dark-liquid-company',
                'publish_date' => '2019-03-24 14:26:00', 
                'user_id' => 1,
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "dark-liquid-company\icon.png"
            ], 
            'jam' => [
                'name' => "Pizza Jam",
                'slug' => "pizza-jam",
                'entries' => 53,
                'theme' => "I am the strongest!",
                'start_date' => "2019-03-22 19:00:00",
                'end_date' => "2019-03-24 19:00:00"
            ],
            'jam_icon' => [ 
                'type' => Image::ICON, 
                'path' => "pizza-jam.jpg"
            ]
        ],
        [
            'game' => [
                'name' => 'Escape from the bank',
                'slug' => 'escape-from-the-bank',
                'publish_date' => '2019-04-29 20:42:00', 
                'user_id' => 1,
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "escape-from-the-bsnk\icon.png"
            ], 
            'jam' => [
                'name' => "Ludum Dare 44",
                'slug' => "ludum-dare-44",
                'entries' => 2538,
                'theme' => "Your life is currency",
                'start_date' => "2019-04-27 03:00:00",
                'end_date' => "2019-04-30 03:00:00"
            ],
            'jam_icon' => [
                'type' => Image::ICON, 
                'path' => "ludum-dare-44.jpg"
            ]
        ], 
        [
            'game' => [
                'name' => 'Pothole panic',
                'slug' => 'pothole-panic',
                'publish_date' => '2020-02-22 15:51:00', 
                'user_id' => 1,
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "pothole-panic\icon.png"
            ], 
            'jam' => [
                'name' => "Brackeys Game Jam 2020.1",
                'slug' => "brackeys-3",
                'entries' => 700,
                'theme' => "Holes",
                'start_date' => "2020-02-16 09:00:00",
                'end_date' => "2020-02-23 09:00:00"
            ],
            'jam_icon' => [
                'type' => Image::ICON, 
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
            $game = null;

            if (array_key_exists('jam', $data)) {
                $jam = Jam::create($data['jam']);   
                $jam->icon()->create($data['jam_icon']);
                
                $game = $jam->games()->create($data['game']);
            } else {
                $game = Game::create($data['game']);
            }
            
            $game->images()->create($data['game_icon']);

        }
    }
}
