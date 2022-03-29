<?php 

namespace Database\MigrationClasses;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\MigrationClasses\Base as BaseMigrationClass;

class CreatePersonalAccessTokens extends BaseMigrationClass
{
    public static function createSchema()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists("personal_access_tokens");
    } 
}