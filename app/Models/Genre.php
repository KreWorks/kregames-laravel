<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * The games that belongs to a genre
     */
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}