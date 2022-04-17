<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\LinksMigrationHelper;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LinksMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        LinksMigrationHelper::dropIfExists();
    }
}
