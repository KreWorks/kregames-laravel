<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TranslationsMigrationHelper 
{
    public static function runMigration()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('language_id');
            $table->foreignId('contenttype_id');
            $table->morphs('translatable');
            $table->text('content');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('translations', function (Blueprint $table) {
            $table->dropForeign('translations_language_id_foreign');
            $table->dropForeign('translations_contenttype_id_foreign');
        });
    }

}