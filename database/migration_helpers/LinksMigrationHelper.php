<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinksMigrationHelper
{
    public static function runMigration()
    {
        Schema::create("links", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->morphs('linkable');
            $table->foreignId('linktype_id')->nullable()->constrained();
            $table->string('link');
            $table->string('display_text')->nullable();
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('links');
    }

    /**
     * Handles the update of the table with the display field
     */
    public static function update($index)
    {
        if ($index == 1) {
            Schema::table('links', function($table) {
                $table->boolean('visible')->default(true);
            });
        }
    }
    public static function downGrade($index)
    {
        if ($index == 1) {
            Schema::table('links', function($table) {
                $table->dropColumn('visible');
            });
        }
    }

}