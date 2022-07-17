<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\ContenttypesMigrationHelper;

class CreateContenttypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ContenttypesMigtaionHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ContenttypesMigtaionHelper::dropIfExists();
    }
}
