<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinktypesMigrationHelper
{
    public static function createSchema()
    {
        Schema::create("linktypes", function (Blueprint $table){
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('linktypes');
    }

}