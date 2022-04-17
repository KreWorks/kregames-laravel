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

    public function hasSeeder()
    {
        return class_exists($this->getSeederClass());
    }

    public function getSeederClass()
    {
        $className = substr(self::GetTableName($this->migration), 0, -1);
        $className .= "Seeder";

        return "Database\\Seeders\\".$className;
    }

    public function getTableNameAttribute()
    {
        $tableName = self::GetTableName($this->migration);
        $tableName = preg_replace('/([A-Z])/', '_$1', $tableName);
        $tableName = substr(strtolower($tableName), 1);

        return $tableName; 
    }

    public static function GenerateHelperClassName($migration)
    {
        $className = self::GetTableName($migration);
        //Append MigrationHelper to get final className 
        $className .= "MigrationHelper";

        return $className;
    }

    public static function GetTableName($migration)
    {
        //Remove timestamp params at start 
        $className = substr($migration, 18);
        //Make it PascalCase 
        $className = ucwords($className,'_'); 
        //Replace migration key words
        $className = str_replace(['Create', 'Table','Add', 'Field'], ['','','',''], $className); //Replace not needed parts
        //Replace underscrore
        $className = str_replace('_', '', $className);

        return $className;
    }    
}
