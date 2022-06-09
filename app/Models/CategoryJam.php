<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryJam extends Pivot
{
    public $timestamps = false;
    public $incrementing = true;
    
    public static $tableLabels = [
        'jam' => 'jam',
        'category' => 'kategória',
        'fontawesome' => "FontAwesome"
    ];

    public static $tableLabelsForParent = [
        'category' => 'kategória',
        'fontawesome' => "FontAwesome"
    ];

    protected $fillable = ['jam_id', 'category_id'];

    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
