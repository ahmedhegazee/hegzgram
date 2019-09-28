<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('comment.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post)
    {
        $data=$request->validate([
            'content' =>'required|string|max:255',
        ]);
       $profid= $post->user->profile->id;
       $post->comments()->create([
           'content'=>$data['content'],
           'profile_id'=>$profid,
       ]);
       return redirect(route('post.show',['post'=>$post->id])) ;
    }


}
