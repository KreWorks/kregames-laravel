<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = ['id', 'migration', 'batch'];

    public function getHelperClassNameAttribute()
    {
        return self::GenerateHelperClassName($this->migration);
    }

    public static function GenerateHelperClassName($migration)
    {
        //Remove timestamp params at start 
        $className = substr($migration, 18);
        //Make it PascalCase 
        $className = ucwords($className,'_'); 
        //Replace migration key words
        $className = str_replace(['Create', 'Table','Add', 'Field'], ['','','',''], $className); //Replace not needed parts
        //Replace underscrore
        $className = str_replace('_', '', $className);
        //Append MigrationHelper to get final className 
        $className .= "MigrationHelper";

        return $className;
    }
    
}
