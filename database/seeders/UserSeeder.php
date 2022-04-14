<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Image; 
use App\Models\Link;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path()."/database/seeds/users.json");
        $datas = json_decode($jsonData, true);

        foreach($datas as $data)
        {
            $this->createOrUpdate($data);
        }
    }

    protected function createOrUpdate($data)
    {
        $id = $data['id'];
        unset($data['id']);
        $avatar = $data['avatar'];
        unset($data['avatar']);
        $links = $data['links'] ? $data['links'] : [];
        unset($data['links']);

        $data['password'] = Hash::make($data['password']);
        $user = User::updateOrCreate(
            ['id' =>  $id],
            $data
        );

        //Avatar
        $avatar['type'] = Image::ICON;
        $avatar['imageable_type'] = "App\Models\User";
        $avatar['imageable_id'] = $id;
        $user->avatar()->firstOrCreate([
            "imageable_type" => "App\Models\User", 
            "imageable_id" => $id,
             "type" => Image::ICON
            ],
            $avatar
        );

        //update links
        //Delete existing
        Link::where([
            'linkable_type' => "App\Models\User", 
            "linkable_id" => $id
        ])->delete();
        //Insert new ones
        foreach($links as $l)
        {
            $link = $user->links()->create($l); 
            $link->linktype()->associate($l['linktype_id']);
            $link->save();
        }
    }
}
