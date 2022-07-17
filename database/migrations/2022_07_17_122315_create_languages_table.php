<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\LanguagesMigrationHelper;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguagesMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        LanguagesMigrationHelper::dropIfExists();
    }
}
