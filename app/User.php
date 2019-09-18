<?php

namespace App;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function($user){
            $data=[
                'title'=>$user->username,
                'image'=>'default/ccRp67CBjTSpm5R0SlR82dHK0qe0dpkj9CI6MepV.png'
            ];
            $user->profile()->create($data);
            //Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
}
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function like()
    {
        return $this->belongsToMany(Post::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
