<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Link;

class Linktype extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'name' => 'név',
        'fontawesome' => "ikon",
    ];

    protected $fillable = ['name', 'fontawesome', 'color'];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function getFontawesomeIconAttribute()
    {
        return $this->fontawesome;
    }

    public function getFontawesomeColorAttribute()
    {
        return $this->color;
    }

    public function getDeleteStringAttribute()
    {
        return $this->name . " (ID: ".$this->id.")";
    }
}
