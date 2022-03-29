<?php 

namespace Database\MigrationClasses;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\MigrationClasses\Base as BaseMigrationClass;

class CreateUsers extends BaseMigrationClass
{
    public static function createSchema()
    {
        Schema::create("password_resets", function (Blueprint $table) {
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
        Schema::dropIfExists("password_resets");
    } 
}