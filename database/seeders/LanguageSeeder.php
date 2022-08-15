<?php

namespace Database\Seeders;

use App\Models\Language;

class LanguageSeeder extends DatabaseSeeder
{
    protected $seederFile = "/database/seeds/languages.json";

    protected function createOrUpdate($data)
    {
        $id = $data['id'];
        unset($data['id']);

        $language = Language::updateOrCreate(
            ['id' =>  $id],
            $data
        );
    }
}