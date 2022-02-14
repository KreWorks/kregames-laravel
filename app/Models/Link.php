<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'link' => 'link',
        'linkType' => "típus",
    ];

    public static $morphsToClasses = [
        'User', 
        'Game',
        'Jam'
    ];

    protected $morphClass = 'Link';
    protected $fillable = ['link', 'display_text'];

    /**
     * Get the parent linkable model (user, game, jam).
     */
    public function linkable()
    {
        return $this->morphTo();
    }

    public function linkType()
    {
        return $this->belongsTo(LinkType::class);
    }

    public function getParentAttribute()
    {
        return $this->linkable_type;
    }

    /**
     * Return the path to the icon of the jam
     */
    public function getLinkTypeAttribute()
    {
        $icon = $this->linkType->fontawesome; 
        $color = $this->linkType->color;
        return '<i class="fa-solid '.$icon.'" style="color:'.$color.'"></i>';
    }
}
