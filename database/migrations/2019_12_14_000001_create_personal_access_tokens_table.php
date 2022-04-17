<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\PersonalAccessTokensMigrationHelper;

class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PersonalAccessTokensMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PersonalAccessTokensMigrationHelper::dropIfExists();
    }
}
