<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Image; 

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
            $avatar = $data['avatar'];
            unset($data['avatar']);

            $user = User::create($data);
            $user->avatar()->create($avatar);
        }
    }
}
