<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingCategory extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'name' => 'név',
        'fontawesome' => "FontAwesome"
    ];

    protected $fillable = ['name', 'slug','fontawesome'];

    
}
