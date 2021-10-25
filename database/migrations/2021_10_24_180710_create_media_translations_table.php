<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id');
            $table->unique(['media_id', 'locale']);
            $table->foreign('media_id')->references('id')->on('medias')->onDelete('cascade');

            $table->string('locale', 10);
            $table->text('description');
            $table->string('alt', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_translations');
    }
}
