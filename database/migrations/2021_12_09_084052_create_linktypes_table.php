<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationClasses\CreateLinktypes;

class CreateLinktypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CreateLinktypes::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CreateLinktypes::dropIfExists();
    }
}
