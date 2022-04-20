<?php 

namespace App\Traits;

trait MigrationTrait 
{
    /**
     * migration could be a filename as well
     */
    public function GenerateHelperClassName($migration)
    {
        $className = $this->GetTableName($migration, true);
        //Append MigrationHelper to get final className 
        $className .= "MigrationHelper";

        return "Database\\MigrationHelpers\\".$className;
    }

    public function GetActionName($fileName, $isUp = true)
    {
        $type = $this->GetType($fileName);
        if ($type == 'create' && $isUp) {
            return 'runMigration';
        } 
        else if ($type == 'create' && !$isUp) {
            return 'dropIfExists';
        }
        else if ($type == 'update') {
            if ($isUp) {
                return 'update';
            } else {
                return 'downGrade';
            }
        }

        return 'error';
    }

    public function DisplayHelperAndAction($fileName) 
    {
        $helper = $this->GenerateHelperClassName($fileName);
        $helper = str_replace("Database\\MigrationHelpers\\", '', $helper);

        $index = $this->GetUpdateNumber($fileName);

        return $helper."::".$this->GetActionName($fileName)."(".($index == 0 ? '' : $index).")";
    }

    /**
     * Return the table name of the migration
     * defatult is with underscore 
     * isPascalCase return no underscore, but pascalCase answer
     */
    public function GetTableName($migration, $isPascalCase = false)
    {
        //Remove parts 
        $className = $this->RemoveTimestamp($migration);
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
    
    public function GetType($migration)
    {
        //Remove parts 
        $type = $this->RemoveTimestamp($migration);
        //Get the table name 
        $tableName = $this->GetTableName($migration); 

        //Replace needed words
        $type = preg_replace(['/table/', '/[0-9]/', '/'.$tableName.'/'], '', $type); 
        //Replace underscrore
        $type = str_replace('_', '', $type);

        return $type;
    }

    public function GetUpdateNumber($migration)
    {
        $type = $this->GetType($migration);
        if ($type == 'update')
        {
            $number = $this->RemoveTimestamp($migration);
            $tableName = $this->GetTableName($migration); 
            $number = str_replace(['create', 'update', 'table', $tableName], '', $number);
            $number = str_replace('_','', $number);

            return $number;
        }

        return 0;
    }

    public function RemoveTimestamp($migration)
    {
        //Remove timestamp params at start 
        $returnString = substr($migration, 18);

        return $returnString;
    }
}