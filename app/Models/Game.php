<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    
    public $translatedAttributes = ['description'];

    /**
     * Get the jam in which the game participated
     */
    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }

    /**
     * Get the genres of the game
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
