<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use App\Models\Image;
use DateTime;

class Jam extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'iconPath' => 'icon',
        'id' => 'id',
        'name' => 'név',
        'theme' => 'téma',
        'entries' => 'versenyzők',
        'start_date' => 'kezdés',
        'end_date' => 'vég',
        'duration' => 'hossz'
    ];

    protected $fillable = ['name', 'slug','entries', 'theme', 'start_date', 'end_date'];
    /**
     * The games related to this jam
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    /**
     * Get the jam's links
     */
    public function links()
    {
        return $this->morphMany('App\Models\Link', 'linkable');
    }

    /**
     * Get the jam's icon
     */
    public function icon()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', Image::ICON);
    }

   /**
     * The ratingCategories that belong to the jam.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_jam')->using(CategoryJam::class)->withPivot('id');
    } 

    /**
     * Return the path to the icon of the jam
     */
    public function getIconPathAttribute()
    {
        return $this->icon ? $this->icon->path : '';
    }

    /**
     * Return jam length in days
     */
    public function getDurationAttribute()
    {
        $start = new DateTime($this->start_date);
        $end = new DateTime($this->end_date);
        $interval = $start->diff($end);

        return  $interval->format('%a nap');
    }

    public function getDeleteStringAttribute()
    {
        return $this->name . " (ID: ".$this->id.")";
    }
}
