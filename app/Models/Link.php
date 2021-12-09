<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

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
