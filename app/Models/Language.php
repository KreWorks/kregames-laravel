<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Translation;

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

    public static function getTranslatables()
    {
        $translatables = []; 
        foreach(Translation::$morphs as $key => $class)
        {
            $translatables[$key] = [
                'css-class' => strtolower($key), 
                'model' => $class,
                'items' => $class::all()
            ];
        }

        return $translatables;
    }

    /**
     * The translations related to this language
     */
    public function translations()
    {
        return $this->hasMany(Translation::class);
    }

    public function getDeleteStringAttribute()
    {
        return $this->name . " (ID: ".$this->id.")";
    }
}
