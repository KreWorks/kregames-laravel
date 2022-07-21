<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenttype extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'model' => "típus",
        'name' => 'név'
    ];

    protected $fillable = ['model', 'name'];

    public static $modelTypes = [
        'Page' => 'PAGE',
        'Game' => 'App\Models\Game',
        'User' => 'App\Models\User'
    ];

    public function getDeleteStringAttribute()
    {
        return $this->model ." típushoz tartozó ".$this->name . " (ID: ".$this->id.")";
    }
}
