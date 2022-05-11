<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Jam; 
use App\Models\Link;
use App\Models\Game;

class JamSeeder extends Seeder
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
                
                if ($index < 4 && array_key_exists('jam', $data)) {
                    $jamData = $data['jam'];
                    // Create or update the game itself
                    $jam = $this->createOrUpdate($jamData);
                
                    // Check for logo for the game 
                    if (array_key_exists('logo', $data)) {
                        $logo = Image::where(['type' => Image::ICON, 'imageable_type' => Jam::class, 'imageable_id' => $jam->id])->first();

                        $jamData['logo']['type'] = Image::ICON;

                        if ($logo) {
                            $logo->update($jamData['logo']); 
                        } else {
                            $jam->icon()->create($jamData['logo']);
                        }                        
                    }
                    
                    // Check for game, and associate if exists
                    $game = Game::find($data['id']);

                    if ($game) {
                        $game->jam()->associate($jam);
                        $game->save();
                    }
                    
                    // Check for links 
                    if (array_key_exists('links', $jamData) && count($jamData['links']) > 0) {
                        Link::where(['linkable_type' => Jam::class, 'linkable_id' => $jam->id])->delete();

                        foreach($jamData['links'] as $linkData) {
                            $jam->links()->create($linkData);
                        }
                    }

                    // Check for categories and add if exists
                    /*if (array_key_exists('categories', $jamData) && count($jamData['categories']) > 0) {
                        foreach($jamData['categories'] as $category) {
                            $category = Category::updateOrCreate(
                                ['name' => $category], 
                                [$category]
                            );
                            // todo check if exists (or delete all related stuff)
                            $jam->categories()->attach($category->id);
                        }
                    }*/
                }
            }
        }
    }

    protected function createOrUpdate($data)
    {
        $game = Jam::updateOrCreate(
            ['id' =>  $data['id']],
            $this->getData($data)
        );

        return $game;
    }

    protected function getData($dataJson) 
    {
        $data = []; 
        $fields = Jam::$jsonFields;
        foreach($dataJson as $key => $value) 
        {
            if (in_array($key, $fields)) 
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
