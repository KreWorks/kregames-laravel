<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\MigrationTrait;
use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    use HasFactory, MigrationTrait;
    
    public $timestamps = false;
    protected $fillable = ['id', 'migration', 'batch'];

    public function getHelperClassNameAttribute()
    {
        return $this->GenerateHelperClassName($this->migration);
    }

    public function hasSeeder()
    {
        return class_exists($this->getSeederClass());
    }

    public function getSeederClass()
    {
        $className = substr($this->GetTableName($this->migration, true), 0, -1);
        $className .= "Seeder";

        return "Database\\Seeders\\".$className;
    }

    public function getTableNameAttribute()
    {
        $tableName = $this->GetTableName($this->migration);
    
        return $tableName; 
    }

    
}
