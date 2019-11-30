<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded=[];
    public function comment()
    {
       return $this->belongsTo(Comment::class);
    }

    public function profile()
    {
       return $this->belongsTo(Profile::class);

    }
    public function liked()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
