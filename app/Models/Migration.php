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
        $className = substr(self::GetTableName($this->migration, true), 0, -1);
        $className .= "Seeder";

        return "Database\\Seeders\\".$className;
    }

    public function getTableNameAttribute()
    {
        $tableName = self::GetTableName($this->migration, true);
        $tableName = preg_replace('/([A-Z])/', '_$1', $tableName);
        $tableName = substr(strtolower($tableName), 1);

        return $tableName; 
    }

    /**
     * migration could be a filename as well
     */
    public static function GenerateHelperClassName($migration)
    {
        $className = self::GetTableName($migration, true);
        //Append MigrationHelper to get final className 
        $className .= "MigrationHelper";

        return "Database\\MigrationHelpers\\".$className;
    }

    /**
     * migration could be a filename as well
     */
    public static function GetTableName($migration, $isPascalCase = false)
    {
        //Remove parts 
        $className = self::RemoveTimestampAndExtension($migration);
        
        //ReplaceWords
        $replaceWords = ['create', 'table','update'];
        //Make it PascalCase 
        if($isPascalCase) {
            $className = ucwords($className,'_'); 
            $replaceWords = ['Create', 'Table','Update'];
        } 
        //Replace migration key words
        $className = str_replace($replaceWords, '', $className); //Replace not needed parts
        //Replace underscrore
        $className = str_replace('_', '', $className);

        return $className;
    }
    
    public static function GetType($migration)
    {
        //Remove parts 
        $type = self::RemoveTimestampAndExtension($migration);
        //Get the table name 
        $tableName = self::GetTableName($migration); 
        //Replace needed words
        $type = str_replace(['table', $tableName], '', $type); 
        //Replace underscrore
        $type = str_replace('_', '', $type);

        return $type;
    }

    public static function RemoveTimestampAndExtension($migration)
    {
        //Remove timestamp params at start 
        $returnString = substr($migration, 18);

        return $returnString;
    }
}
