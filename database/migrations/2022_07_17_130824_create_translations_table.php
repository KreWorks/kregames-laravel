<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationHelpers\TranslationsHelper;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        TranslationsMigrationHelper::runMigration();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        TranslationsMigrationHelper::dropIfExists();
    }
}
