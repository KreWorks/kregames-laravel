<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;
use App\Models\Contenttype;
use App\Models\Game; 
use App\Models\User;

class Translation extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'language' => 'nyelv',
        'contenttype' => "típus",
        'content' => 'tartalom'
    ];

    protected $fillable = ['language_id', 'contettype_id','content'];

    public static $morphs = [
        'Page' => 'Page',
        'Game' => Game::class,
        'User' => User::class
    ];

    public static function getTranslatables()
    {
        $translatables = []; 
        foreach(Translation::$morphs as $key => $class)
        {
            if ($key !== 'Page') {
                $translatables[$key] = [
                    'css-class' => strtolower($key), 
                    'model' => $class,
                    'items' => $class::all()
                ];
            } else {
                $translatables[$key] = [
                    'css-class' => strtolower($key), 
                    'model' => $class,
                    'items' => "Page"
                ];
            }
        }

        return $translatables;
    }

    /**
     * Get the language of the translation
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the type of the translation
     */
    public function contenttype()
    {
        return $this->belongsTo(Contenttype::class);
    }

    /**
     * Get the parent translatable model (game or user).
     */
    public function translatable()
    {
        return $this->morphTo();
    }

    public function getDeleteStringAttribute()
    {
        return $this->language . " (ID: ".$this->id.")";
    }
}
