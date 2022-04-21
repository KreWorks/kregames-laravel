<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\RatingsMigrationHelper;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        RatingsMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        RatingsMigrationHelper::dropIfExists();
    }
}
