<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\PasswordResetsMigrationHelper;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PasswordResetsMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PasswordResetsMigrationHelper::dropIfExists();
    }
}
