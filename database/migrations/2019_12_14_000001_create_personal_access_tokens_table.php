<?php

use Illuminate\Database\Migrations\Migration;
use Database\MigrationClasses\CreatePersonalAccessTokens;

class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        CreatePersonalAccessTokens::createSchema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CreatePersonalAccessTokens::dropIfExists();
    }
}
