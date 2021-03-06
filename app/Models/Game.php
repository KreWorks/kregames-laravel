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

    public static $tableLabels = [
        'iconPath' => 'icon',
        'id' => 'id',
        'name' => 'név',
        'jamName' => "jam",
        'publish_date' => 'kiadási dátum', 
        'visible' => 'látható'
    ];

    protected $fillable = ['name', 'slug','publish_date', 'user_id','visible'];

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
     * Get the game's links
     */
    public function links()
    {
        return $this->morphMany('App\Models\Link', 'linkable');
    }

    public function ratings()
    {
        return $this->belongsToMany(Category::class, 'ratings')->using(Rating::class)->withPivot('id','place', 'average_point', 'rating_count');
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, Jam::class);
    }

    /**
     * Return the path to the icon of the jam
     */
    public function getIconPathAttribute()
    {
        return $this->icon ? $this->icon->path : '';
    }

    public function getReleaseDateAttribute()
    {
        return substr($this->publish_date, 0, 10);
    }

    public function getDeleteStringAttribute()
    {
        return $this->name . " (ID: ".$this->id.")";
    }
}
