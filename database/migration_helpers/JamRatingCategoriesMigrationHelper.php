<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JamRatingCategoriesMigrationHelper
{
    public static function runMigration()
    {
        Schema::create("jam_rating_categories", function (Blueprint $table) {
            $table->id();
            $table->foreignId('jam_id');
            $table->foreignId('rating_category_id');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('games', function (Blueprint $table) {
            $table->dropForeign('jam_rating_categories_jam_id_foreign');
            $table->dropForeign('jam_rating_categories_rating_category_id_foreign');
        });
    } 
}