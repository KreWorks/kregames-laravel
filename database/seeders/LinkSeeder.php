<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user links
        $jsonData = file_get_contents(base_path()."/database/seeds/users.json");
        $users = json_decode($jsonData, true);

        foreach($users as $user)
        {
            $links = $user['links'] ? $user['links'] : [];
            $this->createOrUpdate($links, $user['id'], "App\Models\User");
        }

        //jam links
        $jsonData = file_get_contents(base_path()."/database/seeds/jams.json");
        $jams = json_decode($jsonData, true);

        foreach($jams as $jam)
        {
            $links = $jam['links'] ? $jam['links'] : [];
            $this->createOrUpdate($links, $jam['id'], "App\Models\Jam");
        }

        //game links
        $jsonData = file_get_contents(base_path()."/database/seeds/games.json");
        $games = json_decode($jsonData, true);

        foreach($games as $game)
        {
            $links = $game['links'] ? $game['links'] : [];
            $this->createOrUpdate($links, $game['id'], "App\Models\Game");
        }
    }

    protected function createOrUpdate($links, $parentId, $parentType)
    {
        $parent = $parentType::find($parentId);
        //Delete existing
        Link::where([
            'linkable_type' => $parentType, 
            "linkable_id" => $parentId
        ])->delete();

        //Insert new ones
        foreach($links as $l)
        {
            $link = $parent->links()->create($l); 
            $link->linktype()->associate($l['linktype_id']);
            $link->save();
        }        
    }
}