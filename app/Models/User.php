<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Image;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static $tableLabels = [
        'avatarPath' => 'avatar',
        'id' => 'id',
        'name' => 'név',
        'username' => 'felhaszálónév',
        'email' => 'email'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the game's icon
     */
    public function avatar()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', Image::ICON);
    }

    /**
     * The games related to this jam
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function getAvatarPathAttribute()
    {
        return $this->avatar ? $this->avatar->path : '';
    }

    public function getDeleteStringAttribute()
    {
        return $this->name;
    }
}
