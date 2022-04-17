<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\JamsMigrationHelper;

class CreateJamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        JamsMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        JamsMigrationHelper::dropIfExists();
    }
}
