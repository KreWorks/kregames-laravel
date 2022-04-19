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
        $tableName = self::GetTableName($this->migration);
    
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

    public static function GetActionName($fileName, $isUp = true)
    {
        $type = Migration::GetType($fileName);
        if ($type == 'create' && $isUp) {
            return 'runMigration';
        } 
        else if ($type == 'create' && !$isUp) {
            return 'dropIfExists';
        }
        else if ($type == 'update') {
            $number = Migration::GetUpdateNumber($fileName);
            if ($isUp) {
                return 'update'.$number;
            } else {
                return 'downGrade'.$number;
            }
        }

        return 'error';
    }

    public static function DisplayHelperAndAction($fileName) 
    {
        $helper = self::GenerateHelperClassName($fileName);
        $helper = str_replace("Database\\MigrationHelpers\\", '', $helper);

        return $helper."::".self::GetActionName($fileName);
    }

    /**
     * Return the table name of the migration
     * defatult is with underscore 
     * isPascalCase return no underscore, but pascalCase answer
     */
    public static function GetTableName($migration, $isPascalCase = false)
    {
        //Remove parts 
        $className = self::RemoveTimestamp($migration);
        //ReplaceWords
        $replaceWords = ['/Create/', '/Table/','/Update/', '/[0-9]/'];
        //Make it PascalCase 
        $className = ucwords($className,'_'); 
        //Replace migration key words
        $className = preg_replace($replaceWords, '', $className); 
        //Replace underscrore
        $className = str_replace('_', '', $className);

        if ($isPascalCase) {
            return $className;
        }

        //Replace uppercase letter with _
        $className = preg_replace('/([A-Z])/', '_$1', $className);
        //lower string and cut start _
        $className = substr(strtolower($className), 1);

        return $className;
    }
    
    public static function GetType($migration)
    {
        //Remove parts 
        $type = self::RemoveTimestamp($migration);
        //Get the table name 
        $tableName = self::GetTableName($migration); 

        //Replace needed words
        $type = preg_replace(['/table/', '/[0-9]/', '/'.$tableName.'/'], '', $type); 
        //Replace underscrore
        $type = str_replace('_', '', $type);

        return $type;
    }

    public static function GetUpdateNumber($migration)
    {
        $type = self::GetType($migration);
        if ($type == 'update')
        {
            $number = self::RemoveTimestamp($migration);
            $tableName = self::GetTableName($migration); 
            $number = str_replace(['create', 'update', 'table', $tableName], '', $number);
            $number = str_replace('_','', $number);

            return $number;
        }

        return 0;
    }

    public static function RemoveTimestamp($migration)
    {
        //Remove timestamp params at start 
        $returnString = substr($migration, 18);

        return $returnString;
    }
}
