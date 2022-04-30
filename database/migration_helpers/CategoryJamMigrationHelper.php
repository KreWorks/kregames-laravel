<?php 

namespace Database\MigrationHelpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryJamMigrationHelper
{
    public static function runMigration()
    {
        Schema::create("category_jam", function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('jam_id');
        });
    }

    public static function dropIfExists()
    {
        Schema::dropIfExists('category_jam', function (Blueprint $table) {
            $table->dropForeign('category_jam_jam_id_foreign');
            $table->dropForeign('category_jam_category_id_foreign');
        });
    } 
}