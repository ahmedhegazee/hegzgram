<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function store(Post $post)
    {
        return auth()->user()->like()->toggle($post);
    }

    public function count(Post $post)
    {
        return $post->liked()->count();
    }
}
