<?php

use Illuminate\Database\Migrations\Migration;

use Database\MigrationClasses\CreateJams;

class CreateJamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CreateJams::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CreateJams::dropIfExists();
    }
}
