<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liked()
    {
        return $this->belongsToMany(User::class);
    }

    public function postImage()
    {
        //$image ='/storage/'.$this->image;
        $image = $this->image;
        return $image ;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
