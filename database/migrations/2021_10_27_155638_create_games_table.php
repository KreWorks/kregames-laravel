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
            $table->integer('icon')->unsigned();
            $table->foreign('icon')->reference('id')->on('medias')->onDelete('cascade');
            $table->integer('jam_id')->nullable()->unsigned();
            $table->foreing('jam_id')->reference('id')->on('jams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
