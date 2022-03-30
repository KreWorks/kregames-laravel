<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationClasses\CreateGames;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CreateGames::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CreateGames::dropIfExists();
    }
}
