<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\ImagesMigrationHelper;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ImagesMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ImagesMigrationHelper::dropIfExists();
    }
}
