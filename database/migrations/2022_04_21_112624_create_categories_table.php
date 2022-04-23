<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\CategoriesMigrationHelper;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CategoriesMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CategoriesMigrationHelper::dropIfExists();
    }
}
