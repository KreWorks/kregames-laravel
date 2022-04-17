<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinktypesMigrationHelper
{
    public static function runMigration()
    {
        Schema::create("linktypes", function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('fontawesome');
            $table->string('color');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('linktypes');
    }

}