<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationClasses\CreateUsers;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CreateUsers::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CreateUsers::dropIfExists();
    }
}
