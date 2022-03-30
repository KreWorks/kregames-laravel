<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\FailedJobsMigrationHelper;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        FailedJobsMigrationHelper::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        FailedJobsMigrationHelper::dropIfExists();
    }
}
