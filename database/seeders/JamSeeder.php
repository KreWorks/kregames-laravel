<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class JamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'content_id' => 1, 
            'content_type' => App\Models\Jam::class,
            'path' => "brackeys-2.jpg"
        ]);

        DB::table('jams')->insert([
            'id' => 2,
            'name' => "Pizza Jam",
            'slug' => "pizza-jam",
            'entries' => 53,
            'theme' => "I am the strongest!",
            'start_date' => "2019-03-22 19:00:00",
            'end_date' => "2019-03-24 19:00:00"
        ]);
        DB::table('images')->insert([
            'id' => 2, 
            'type' => Image::ICON, 
            'content_id' => 2, 
            'content_type' => App\Models\Jam::class,
            'path' => "pizza-jam.jpg"
        ]);
        
        DB::table('jams')->insert([
            'id' => 3,
            'name' => "Ludum Dare 44",
            'slug' => "ludum-dare-44",
            'icon' => 3, 
            'entries' => 2538,
            'theme' => "Your life is currency",
            'start_date' => "2019-04-27 03:00:00",
            'end_date' => "2019-04-30 03:00:00"
        ]);
        DB::table('images')->insert([
            'id' => 3, 
            'type' => Image::ICON, 
            'content_id' => 3, 
            'content_type' => App\Models\Jam::class,
            'path' => "ludum-dare-44.jpg"
        ]);

        DB::table('jams')->insert([
            'id' => 4,
            'name' => "Brackeys Game Jam 2020.1",
            'slug' => "brackeys-3",
            'icon' => 4, 
            'entries' => 700,
            'theme' => "Holes",
            'start_date' => "2020-02-16 09:00:00",
            'end_date' => "2020-02-23 09:00:00"
        ]);
        DB::table('images')->insert([
            'id' => 4, 
            'type' => Image::ICON, 
            'content_id' => 4, 
            'content_type' => App\Models\Jam::class,
            'path' => "brackeys-3.jpg"
        ]);

    }
}
