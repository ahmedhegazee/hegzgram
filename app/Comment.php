<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded=[];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function user()
    {
        return $this->profile()->user();
    }
    public function liked()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
