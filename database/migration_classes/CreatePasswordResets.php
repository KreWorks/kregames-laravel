<?php 

namespace Database\MigrationClasses;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResets
{
    public static function createSchema()
    {
        Schema::create("password_resets", function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists("password_resets");
    } 
}