<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

abstract class DatabaseSeeder extends Seeder
{
    protected $seederFile = "/database/seeds/languages.json";
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path().$this->seederFile);
        $datas = json_decode($jsonData, true);

        foreach($datas as $data)
        {
            $this->createOrUpdate($data);
        }
    }

    abstract protected function createOrUpdate($data);
}
