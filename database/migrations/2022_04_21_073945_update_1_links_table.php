<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\LinksMigrationHelper;

class Update1LinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LinksMigrationHelper::update(1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        LinksMigrationHelper::downGrade(1);
    }
}
