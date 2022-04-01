<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Linktype;

class LinktypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path()."/database/seeds/linktypes.json");
        $datas = json_decode($jsonData, true);

        foreach($datas as $data)
        {
            $linktype = Linktype::create($data);
        }
    }
}