<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RatingsMigrationHelper
{
    public static function runMigration()
    {
        Schema::create("ratings", function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id');
            $table->foreignId('category_id');
            $table->integer('place');
            $table->float('average_point', 5, 2);
            $table->integer('rating_count');
            
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('ratings', function (Blueprint $table) {
            $table->dropForeign('ratings_game_id_foreign');
            $table->dropForeign('ratings_category_id_foreign');
        });
    } 
}