<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('type');
            $table->foreign('type')->references('id')->on('mediatypes')->onDelete('cascade');

            $table->string('path', 200);

            $table->foreignId('game_id');
            $table->unique(['id', 'game_id']);
            $table->foreign('game_id')->refenrences('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
