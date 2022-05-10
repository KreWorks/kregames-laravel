<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Jam; 
use App\Models\Game;

class GameSeeder extends Seeder
{
    const FILE_DIR = __DIR__.'/../seeds/games/';
    const GAME_DATAS = [
        [
            'game' => [
                'name' => 'One True Pairing',
                'slug' => 'one-true-pairing',
                'publish_date' => '2019-02-23 08:12:00', 
                'user_id' => 1,
                "visible" => true
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "one-true-pairing\icon.png", 
                'title' => 'One True Pairing icon',
                'alt_title' => 'One True Pairing icon'
            ], 
            'jam' => [
                'name' => "Brackey's Game Jam #2",
                'slug' => "brackeys-2",
                'entries' => 318,
                'theme' => "Love is blind",
                'start_date' => "2019-02-16 09:00:00",
                'end_date' => "2019-02-23 09:00:00"
            ],
            'jam_icon' => [
                'type' => Image::ICON, 
                'path' => "brackeys-2.jpg",
                'title' => "Brackey's Game Jam #2 icon",
                'alt_title' => "Brackey's Game Jam #2 icon"
            ]
        ], 
        [
            'game' => [
                'name' => 'Dark Liquid Company',
                'slug' => 'dark-liquid-company',
                'publish_date' => '2019-03-24 14:26:00', 
                'user_id' => 1,
                "visible" => true
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "dark-liquid-company\icon.png",
                'title' => "Dark Liquid Company icon",
                'alt_title' => "Dark Liquid Company icon"
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
                'path' => "pizza-jam.jpg",
                'title' => "Pizza Jam icon",
                'alt_title' => "Pizza Jam icon"
            ]
        ],
        [
            'game' => [
                'name' => 'Escape from the bank',
                'slug' => 'escape-from-the-bank',
                'publish_date' => '2019-04-29 20:42:00', 
                'user_id' => 1,
                "visible" => true
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "escape-from-the-bsnk\icon.png",
                'title' => "Escape from the bank icon",
                'alt_title' => "Escape from the bank icon"
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
                'path' => "ludum-dare-44.jpg",
                'title' => "Ludum Dare 44 icon",
                'alt_title' => "Ludum Dare 44 icon"
            ]
        ], 
        [
            'game' => [
                'name' => 'Pothole panic',
                'slug' => 'pothole-panic',
                'publish_date' => '2020-02-22 15:51:00', 
                'user_id' => 1,
                "visible" => true
            ],
            'game_icon' => [
                'type' => Image::ICON, 
                'path' => "pothole-panic\icon.png",
                'title' => "Pothole panic icon",
                'alt_title' => "Pothole panic icon"
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
                'path' => "brackeys-3.jpg",
                'title' => "Brackeys Game Jam 2020.1 icon",
                'alt_title' => "Brackeys Game Jam 2020.1 icon"
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
        $files = $this->getGameFiles();

        foreach($files as $file) {
            if (file_exists(self::FILE_DIR.$file)) 
            {
                $data = json_decode(file_get_contents(self::FILE_DIR.$file));
                var_dump($data->id);
            }
            

            /*
            if (array_key_exists('jam', $data)) {
                $jam = Jam::create($data['jam']);   
                $jam->icon()->create($data['jam_icon']);
                
                $game = $jam->games()->create($data['game']);
            } else {
                $game = Game::create($data['game']);
            }
            
            $game->images()->create($data['game_icon']);
            */

        }
    }

    protected function getGameFiles()
    {
        $folderScan = scandir(self::FILE_DIR);

        $files = [];
        foreach($folderScan as $file) {
            if ($file != '.' && $file != '..') {
                $files[] = $file;
            }
        }

        sort($files);
        
        return $files;
    }
}
