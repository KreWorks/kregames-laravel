<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use App\Models\Image;

class Jam extends Model
{
    use HasFactory;

    /**
     * The games related to this jam
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    /**
     * The icon of the jam
     */
    public function icon()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}