<?php

namespace Database\Seeders;

use App\Models\Contenttype;

class ContenttypeSeeder extends DatabaseSeeder
{
    protected $seederFile = "/database/seeds/contenttypes.json";

    protected function createOrUpdate($data)
    {
        $id = $data['id'];
        unset($data['id']);

        $user = Contenttype::updateOrCreate(
            ['id' =>  $id],
            $data
        );
    }
}