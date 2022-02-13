<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'iconPath' => 'icon',
        'id' => 'id',
        'name' => 'név',
        'jamName' => "Jam",
        'publish_date' => 'kiadási dátum'
    ];

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
}
