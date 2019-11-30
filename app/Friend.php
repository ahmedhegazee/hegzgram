<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friend extends Pivot

{
    protected $table='friends';

    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }

    public function profile()
    {
        return $this->hasMany(Profile::class,'id','profile_id');
    }
}
