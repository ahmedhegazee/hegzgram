<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class LikesCommentController extends Controller
{

    public function store(Comment $comment)
    {
        return auth()->user()->likeComment()->toggle($comment);
    }

    public function count(Comment $comment)
    {
        return $comment->liked()->count();
    }}
