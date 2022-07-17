<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LanguagesMigrationHelper 
{
    public static function runMigration()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('short')->unique()->index('idx_languages_short');
            $table->string('name');
            $table->boolean('is_active')->default(true);
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('languages', function (Blueprint $table) {
            $table->dropIndex('idx_languages_short');
        });
    }

}