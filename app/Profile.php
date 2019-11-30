<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
}
    public function profileImage()
    {
        $defaultImage='default/ccRp67CBjTSpm5R0SlR82dHK0qe0dpkj9CI6MepV.png';
        $image = ($this->image) ? ($this->image):$defaultImage;

//        return '/storage/'.$image;
        return $image;
    }

    public function comments()
    {
        $this->hasMany(Comment::class);
    }
    public function replies()
    {
        $this->hasMany(Reply::class);
    }
    public function friends()
    {
        return $this->belongsToMany(User::class,'friends')
            ->using('App\Friend')
            ->withPivot('status')
            ->withTimestamps();
    }


}
