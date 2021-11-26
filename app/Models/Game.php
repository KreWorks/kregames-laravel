<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Jam;
use App\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class);
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
        return $this->icon ? $this->icon->path : '';
    }

    public function getJamNameAttribute()
    {
        if ($this->jam != null) {
            return $this->jam->name;
        } else {
            return '-';
        }
    }

    public function getReleaseDateAttribute()
    {
        return substr($this->publish_date, 0, 10);
    }

    public function getDeleteStringAttribute()
    {
        return $this->name;
    }
}
