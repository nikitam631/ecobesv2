<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'slug', 'pic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // relationship for user and profile
    public function user(){
      return $this->belongsTo('App\User');
    }

    // relationship for posts and user- 1 user can have many posts
    public function posts(){
      return $this->hasMany('App\Post');
    }

    //relation between user and like - 1 user can have many likes
    public function likes(){
      return $this->hasMany('App\Like'); 
    }
}
