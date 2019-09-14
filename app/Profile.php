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
        return $this->belongsToMany(User::class);
}
    public function profileImage()
    {
        $defaultImage='default/ccRp67CBjTSpm5R0SlR82dHK0qe0dpkj9CI6MepV.png';
        $image = ($this->image) ? ($this->image):$defaultImage;
        return '/storage/'.$image;
    }
}
