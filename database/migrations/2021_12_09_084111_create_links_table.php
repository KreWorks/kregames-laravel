<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationClasses\CreateLinks;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CreateLinks::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CreateLinks::dropIfExists();
    }
}
