<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Jam; 
use App\Models\Link;
use App\Models\Game;
use App\Models\Rating;
use App\Models\Category;

class GameSeeder extends Seeder
{
    const FILE_DIR = __DIR__.'/../seeds/games/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = $this->getGameFiles();

        foreach($files as $index => $file) {
            if (file_exists(self::FILE_DIR.$file)) 
            {
                $data = json_decode(file_get_contents(self::FILE_DIR.$file), true);
                // Create or update the game itself
                $game = $this->createOrUpdate($data);
            
                // Check for logo for the game 
                if (array_key_exists('logo', $data)) {
                    $logo = Image::where(['type' => Image::ICON, 'imageable_type' => Game::class, 'imageable_id' => $game->id])->first();

                    $data['logo']['type'] = Image::ICON;

                    if ($logo) {
                        $logo->update($data['logo']); 
                    } else {
                        $game->images()->create($data['logo']);
                    }                        
                }
                
                // Check for jam, and associate if exists
                if (array_key_exists('jam', $data)) {
                    $jam = Jam::find($data['jam']['id']);

                    if ($jam) {
                        $game->jam()->associate($jam);
                        $game->save();
                    }
                }

                // Check for links 
                if (array_key_exists('links', $data) && count($data['links']) > 0) {
                    Link::where(['linkable_type' => Game::class, 'linkable_id' => $game->id])->delete();

                    foreach($data['links'] as $linkData) {
                        $game->links()->create($linkData);
                    }
                }

                // Check for ratings and add if exists
                if (array_key_exists('jam', $data) && array_key_exists('ratings', $data)) {
                    foreach($data['ratings'] as $ratingData) {
                        $category = Category::where('name', $ratingData['category'])->first();
                        $categoryName =$category->name;
                        $rating = Rating::where(['game_id' => $data['id']])->whereHas('category', function ($query) use ($categoryName){
                            $query->where(['name' => $categoryName]);
                        })->first();

                        if ($rating) {
                            $rating->update([
                                "rank" => $ratingData['place'],
                                "average_point" => $ratingData['average_point'],
                                "rating_count" => $ratingData['rating_count']
                            ]);
                        } else {
                            $game->ratings()->attach($category, [
                                "rank" => $ratingData['place'],
                                "average_point" => $ratingData['average_point'],
                                "rating_count" => $ratingData['rating_count']
                            ]);
                        }
                    }
                }
                
            }
        }
    }

    protected function createOrUpdate($data)
    {
        $game = Game::updateOrCreate(
            ['id' =>  $data['id']],
            $this->getData($data)
        );

        return $game;
    }

    protected function getData($dataJson) 
    {
        $data = []; 
        foreach($dataJson as $key => $value) 
        {
            if ($key != 'links' && $key != 'logo' && $key != 'jam' && $key != 'ratings') 
            {
                $data[$key] = $value;
            }
        }

        return $data;
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
