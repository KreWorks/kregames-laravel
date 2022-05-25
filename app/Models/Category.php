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
     * The jams that belong to the category.
     */
    public function jams()
    {
        return $this->belongsToMany(Jam::class, 'category_jam')->using(CategoryJam::class)->withPivot('id');
    }

    public function ratings()
    {
        return $this->belongsToMany(Games::class, 'ratings')->using(Rating::class)->withPivot('id','rank', 'average_point', 'rating_count');
    }

    public function GetPivotIdAttribute()
    {
        return $this->pivot->id;
    }

    public function GetJamNameAttribute()
    {
        return $this->jams()->first()->name;
    }

    public function GetJamClassesAttribute()
    {
        //  Category::with('jams')->all()
        $jams = $this->jams()->get();
        $class= "";

        if (count($jams) > 0) 
        {
            foreach($jams as $jam) {
                $class .= " jam-".$jam->id;
            }
        }

        return $class;
    }
}
