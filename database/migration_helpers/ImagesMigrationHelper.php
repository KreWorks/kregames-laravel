<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImagesMigrationHelper
{
    public static function runMigration()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->morphs('imageable');
            $table->string('path');
            $table->string('title');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('images',  function (Blueprint $table) {
            $table->dropIndex('idx_image_game_type');
        });
    } 
}