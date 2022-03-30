<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationClasses\CreateFailedJobs;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CreateFailedJobs::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CreateFailedJobs::dropIfExists();
    }
}
