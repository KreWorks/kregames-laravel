<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public const ICON = 'icon'; 
    public const SCREENSHOOT = 'screenshoot';

    /**
     * Get the parent imageable model (jam or game).
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
