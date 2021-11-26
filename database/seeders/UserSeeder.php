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
        $user = User::create([
            'username' => "kre",
            'name' => 'Réka',
            'email' => "kre@kre.hu",
            'password' => Hash::make("alma123"),
        ]);

        $user->avatar()->create([
            'type' => Image::ICON, 
            'path' => 'noimage',
            'title' => 'kre avatar',
            'alt_title' => 'kre avatar'
        ]);
    }
}
