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
        'link_owner' => 'Szülő',
        'fontawesome' => "típus",
    ];

    public static $morphs = [
        'Game' => 'App\Models\Game',
        'Jam' => 'App\Models\Jam',
        'User' => 'App\Models\User'
    ];

    public static function getLinkables()
    {
        $linakbles = []; 
        foreach(Link::$morphs as $key => $class)
        {
            $linakbles[$key] = [
                'css-class' => strtolower($key), 
                'model' => $class,
                'items' => $class::all()
            ];
        }

        return $linakbles;
    }

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

    public function getLinkOwnerAttribute()
    {
        $owner = $this->linkable_type::find($this->linkable_id);
        $type = str_replace("App\\Models\\", '', $this->linkable_type);

        return $owner->name . " (".$type.")";
    }

    public function getParentEditRouteAttribute()
    {
        $owner = $this->linkable_type::find($this->linkable_id);
        $route = strToLower(array_search($this->linkable_type, self::$morphs)."s");

        return route('admin.'.$route.'.edit', $owner->id);
    }

    /**
     * Return the path to the icon of the jam
     */
    public function getFontawesomeIconAttribute()
    {
        return $this->linktype ? $this->linktype->fontawesome : ''; 
    }

    public function getFontawesomeColorAttribute()
    {
        return $this->linktype ? $this->linktype->color: '#000000';
    }
}
