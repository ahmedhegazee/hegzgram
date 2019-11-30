<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(ResourceType::class,'resource_type_id');
    }
    public function postImage(ResourceType $res)
    {
        $files=[
            'document'=>'/storage/default/word.jpeg',
            'sheet'=>'/storage/default/excel.png',
            'presentation'=>'/storage/default/powerpoint.jpeg',
            'pdf'=>'/storage/default/pdf.jpeg',


        ];
        if($res->name!='image'&& $res->name!='video'&&$res->name!='audio')
            $image = $files[$res->name];
        else
        $image = $this->resource;
        return $image ;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsCount()
    {
        return $this->comments->count();
    }

}
