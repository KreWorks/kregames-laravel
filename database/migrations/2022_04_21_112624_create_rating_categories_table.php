<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\RatingCategoriesMigrationHelper;

class CreateRatingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        RatingCategoriesMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        RatingCategoriesMigrationHelper::dropIfExists();
    }
}
