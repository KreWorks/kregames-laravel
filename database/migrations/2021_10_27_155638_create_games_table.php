<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\GamesMigrationHelper;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        GamesMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        GamesMigrationHelper::dropIfExists();
    }
}
