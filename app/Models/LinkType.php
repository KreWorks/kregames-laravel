<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hover_text', 'fontawesome', 'color'];

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
