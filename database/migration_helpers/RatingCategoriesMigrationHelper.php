<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RatingCategoriesMigrationHelper
{
    public static function runMigration()
    {
        Schema::create("rating_categories", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('fontawesome');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists("rating_categories");
    } 
}