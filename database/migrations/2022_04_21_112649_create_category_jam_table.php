<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\CategoryJamMigrationHelper;

class CreateJamRatingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CategoryJamMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CategoryJamMigrationHelper::dropIfExists();
    }
}
