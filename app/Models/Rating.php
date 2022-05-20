<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rating extends Pivot
{
    use HasFactory;
    
    public $timestamps = false; 
    public $incrementing = true;
   
    protected $table = 'ratings';

    public static $tableLabels = [
        'id' => 'id',
        'game' => 'játék',
        'category' => 'kategória',
        'rank' => "helyezés",
        'average_point' => 'átlag pont',
        'rating_count' => 'szavazat'
    ];

    protected $fillable = ['game_id', 'category_id', 'rank', 'average_point', 'rating_count'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
