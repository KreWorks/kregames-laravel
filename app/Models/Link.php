<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Linktype;

class Link extends Model
{
    use HasFactory;

    public static $tableLabels = [
        'id' => 'id',
        'link' => 'link',
        'linktypeicon' => "típus",
    ];

    public static $morphs = [
        'Game' => 'App\Models\Game'
    ];

    protected $fillable = ['link', 'display_text', 'linktype_id,', 'linkable_type', 'linkable_id'];

    /**
     * Get the parent linkable model (user, game, jam).
     */
    public function linkable()
    {
        return $this->morphTo();
    }

    public function linktype()
    {
        return $this->belongsTo(Linktype::class);
    }

    public function getParentAttribute()
    {
        return $this->linkable_type;
    }

    /**
     * Return the path to the icon of the jam
     */
    public function getLinktypeiconAttribute()
    {
        return  $this->linktype ? $this->linktype->linkTypeIcon : ''; 
    }
}
