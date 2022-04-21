<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\JamRatingCategoriesMigrationHelper;

class CreateJamRatingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        JamRatingCategoriesMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        JamRatingCategoriesMigrationHelper::dropIfExists();
    }
}
