<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites() {
        return $this->hasMany("App\Favorites");
    }

    public function bookmarks() {
        return $this->hasMany("App\Bookmarks");
    }

    public function drafts() {
        return $this->hasMany("App\Drafts");
    }

    public function later() {
        return $this->hasMany("App\Reed_later");
    }

    public function elects() {
        return $this->belongsToMany("App\User", "user_user", "user_id", "elect_id");
    }

    public function stories() {
        return $this->hasMany("App\Story");
    }
}
