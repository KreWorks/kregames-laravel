<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\GamesMigrationHelper;

class Update1GamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        GamesMigrationHelper::update(1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        GamesMigrationHelper::downGrade(1);
    }
}
