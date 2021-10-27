<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('type')->unsigned();
            $table->foreign('type')->reference('id')->on('media_types')->onDelete('cascade');
            $table->index(['content_id', 'type'], 'idx_media_game_type');
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
        Schema::dropIfExists('medias',  function (Blueprint $table) {
            $table->dropForeign('medias_type_foreign');
            $table->dropIndex('idx_media_game_type');
        });

    }
}
