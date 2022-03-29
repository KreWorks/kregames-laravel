<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('slug')->index('idx_games_slug');
            $table->dateTime('publish_date');
            $table->foreignId('user_id');
            $table->foreignId('jam_id')->nullable()->constrained();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games', function (Blueprint $table) {
            $table->dropForeign('games_jam_id_foreign');
            $table->dropIndex('idx_games_slug');
        });
    }
}
