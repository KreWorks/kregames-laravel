<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game; 
use App\Models\Jam;

class Image extends Model
{
    use HasFactory;

    public const ICON = 'icon'; 
    public const SCREENSHOT = 'screenshot';

    public static $morphs = [
        'Game' => 'App\Models\Game',
        'Jam' => 'App\Models\Jam',
        'User' => 'App\Models\User'
    ];

    public static function getImageables()
    {
        $imageables = []; 
        foreach(Image::$morphs as $key => $class)
        {
            $imageables[$key] = [
                'css-class' => strtolower($key), 
                'model' => $class,
                'items' => $class::all()
            ];
        }

        return $imageables;
    }

    public static function getImageTypes()
    {
        return [
            self::ICON => 'icon',
            self::SCREENSHOT => 'screenshot'
        ];
    }

    protected $fillable = ['type', 'path', 'title', 'alt_title'];

    /**
     * Get the parent imageable model (jam or game).
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public static function getImageTypeList()
    {
        return [
            Image::ICON => 'Icon', 
            Image::SCREENSHOT => 'ScreenShot',
        ];
    }

    public static function getMorphList()
    {
        return [
            Game::class => 'játék', 
            Jam::class => 'jam',
            User::class => 'felhasználó'
        ];
    }

    public function getDeleteStringAttribute()
    {
        return $this->path . " (ID: ".$this->id.")";
    }

    public function getParentAttribute()
    {
        return $this->imageable_type;
    }
}
