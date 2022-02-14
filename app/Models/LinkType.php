<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkType extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'name' => 'név',
        'hover_text' => "szöveg",
        'linkTypeIcon' => "ikon",
    ];

    protected $fillable = ['name', 'hover_text', 'fontawesome', 'color'];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Return the path to the icon of the jam
     */
    public function getLinkTypeIconAttribute()
    {
        return '<i class="fa-solid '.$this->fontawesome.'" style="color:'.$this->color.'"></i>';
    }
}
