<?php 

namespace Database\MigrationClasses;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\MigrationClasses\Base as BaseMigrationClass;

class CreateFailedJobs extends BaseMigrationClass
{
    public static function createSchema()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists("failed_jobs");
    } 
}