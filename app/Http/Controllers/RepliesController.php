<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use App\User;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function store(Request $request,Comment $comment)
    {

        $profid= auth()->user()->profile->id;
        $reply =$comment->replies()->create([
            'content'=>$request['params']['content'],
            'profile_id'=>$profid,
        ]);
        return $reply->id;
    }
    public function update(Request $request,Reply $reply)
    {
        $reply->update([
            'content'=>$request['content']
        ]);
        return 'Successful Updating';
    }
    public function destroy(Reply $reply)
    {
        $reply->delete();
        return 'Successful Destroying';
    }
}
