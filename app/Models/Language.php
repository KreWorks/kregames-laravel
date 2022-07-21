<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'short' => 'rövid név',
        'name' => 'név',
        'visible' => 'aktív'
    ];

    protected $fillable = ['short', 'name','visible'];

    public function getDeleteStringAttribute()
    {
        return $this->name . " (ID: ".$this->id.")";
    }
}
