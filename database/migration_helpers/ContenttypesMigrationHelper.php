<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContenttypesMigrationHelper 
{
    public static function runMigration()
    {
        Schema::create('contenttypes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('model');
            $table->string('name');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('contenttypes');
    }

}