<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\ImageMigrationHelper;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ImagesMigrationHelper::createSchema();
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
