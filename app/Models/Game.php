<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Game extends Model
{
    use HasFactory;

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
        foreach($this->images as $image) {
            if ($image->type === Image::ICON)
            {
                return $image;
            }
        }
    }

    /**
     * Get the game's images
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
