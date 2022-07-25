<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Link;
use App\Models\Jam;
use App\Models\User;
use App\Models\Translation;

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
    private $_imageBaseFolder = '/images/games/';
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
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the game's links
     */
    public function links()
    {
        return $this->morphMany(Link::class, 'linkable');
    }

    /**
     * Get the game's translations
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function ratings()
    {
        return $this->belongsToMany(Category::class, 'ratings')->using(Rating::class)->withPivot('id','rank','average_point', 'rating_count');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_jam', 'jam_id', 'category_id')->using(CategoryJam::class, 'jam_id');

        // user to toles return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
        
    }

    /**
     * Return the path to the icon of the jam
     */
    public function getImageFolderAttribute()
    {
        return $this->_imageBaseFolder.$this->slug;
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
