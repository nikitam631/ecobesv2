<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //relationship between user and likes - 1like belongs to 1 user
    public function user(){
      return $this->belongsTo('App\User');
    }
    //relationship between likes and posts
    public function posts(){
      return $this->belongsToMany('App\Post');
    }
}
