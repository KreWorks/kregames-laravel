<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'name' => "kre",
            'email' => "kre@kre.hu",
            'password' => Hash::make("alma123"),
            'email_verified_at' => time(),
        ]);
    }
}
