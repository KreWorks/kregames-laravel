<?php

namespace Database\Seeders;

use App\Models\Linktype;

class LinktypeSeeder extends DatabaseSeeder
{
    protected $seederFile = "/database/seeds/linktypes.json";

    protected function createOrUpdate($data)
    {
        $id = $data['id'];
        unset($data['id']);

        $user = Linktype::updateOrCreate(
            ['id' =>  $id],
            $data
        );
    }
}