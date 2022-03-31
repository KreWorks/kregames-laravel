<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinksMigrationHelper
{
    public static function createSchema()
    {
        Schema::create("links", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->morphs('linkable');
            $table->foreignId('linktype_id')->nullable()->constrained();
            $table->string('link');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('links');
    }

}