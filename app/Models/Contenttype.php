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
        'Game' => Game::class,
        'User' => User::class
    ];

    /**
     * The translations related to this contenttype
     */
    public function translations()
    {
        return $this->hasMany(Contenttype::class);
    }

    public function getDeleteStringAttribute()
    {
        return $this->model ." típushoz tartozó ".$this->name . " (ID: ".$this->id.")";
    }
}
