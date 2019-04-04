<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 1 posts belongs to 1 user only
    public function user(){
      return $this->belongsTo('App\User');
    }

    // 1 post can have more than 1 like 
    public function likes(){
      return $this->belongsToMany('App\Like');
    }
}
