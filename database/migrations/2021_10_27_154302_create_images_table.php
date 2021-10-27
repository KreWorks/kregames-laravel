<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('type');
            $table->index(['content_id', 'type'], 'idx_image_game_type');
            $table->morph('content');
            $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images',  function (Blueprint $table) {
            $table->dropIndex('idx_image_game_type');
        });

    }
}
