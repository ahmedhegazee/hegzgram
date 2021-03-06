<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
       // return $user->username;
        //toggle() is for attach and deattach the relationship
    return auth()->user()->following()->toggle($user->id);
    }
}
