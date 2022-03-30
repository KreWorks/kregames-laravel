<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JamsMigrationHelper
{
    public static function createSchema()
    {
        Schema::create('jams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('slug')->index('idx_jams_slug');
            $table->integer('entries');
            $table->string('theme');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });
    }
    
    public static function dropIfExists()
    {
        Schema::dropIfExists('jams', function (Blueprint $table) {
            $table->dropIndex('idx_jams_slug');
        });
    } 
}