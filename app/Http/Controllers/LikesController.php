<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Reply;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function storePostLike(Post $post)
    {
        return auth()->user()->like()->toggle($post);
    }


    public function storeCommentLike(Comment $comment)
    {
        return auth()->user()->likeComment()->toggle($comment);
    }


    public function storeReplyLike(Reply $reply)
    {
        return auth()->user()->likeReply()->toggle($reply);
    }



}
