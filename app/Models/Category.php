<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public static $tableLabels = [
        'id' => 'id',
        'name' => 'név',
        'fontawesome' => "FontAwesome"
    ];

    protected $fillable = ['name', 'slug','fontawesome'];

    /**
     * The jams that belong to the ratingCategory.
     */
    public function jams()
    {
        return $this->belongsToMany(Jam::class);
    }
    
}
