<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\LinktypesMigrationHelper;

class CreateLinktypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LinktypesMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        LinktypesMigrationHelper::dropIfExists();
    }
}
