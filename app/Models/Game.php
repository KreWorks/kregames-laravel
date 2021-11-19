<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Jam;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','publish_date'];

    /**
     * Get the jam of the game
     */
    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }

    /**
     * Get the game's icon
     */
    public function icon()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', Image::ICON);
    }

    /**
     * Get the game's images
     */
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /** 
     * Return the path to the icon of the jam
     */
    public function getIconPathAttribute()
    {
        return $this->icon->path;
    }

    public function getJamNameAttribute()
    {
        if ($this->jam != null) {
            return $this->jam->name;
        } else {
            return '-';
        }
    }
}
