<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\UsersMigrationHelper;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        UsersMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        UsersMigrationHelper::dropIfExists();
    }
}
