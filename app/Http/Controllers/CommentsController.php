<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CommentsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @param Post $post
     * @return JsonResponse
     */

    public function show(Post $post)
    {
        return \response()->json($this->getComments($post)) ;
    }

    public function getComments(Post $post)
    {

        $comments = $post->comments
            ->map(function ($comment) use ($post) {
            return [
                'id' => $comment->id,
                'post_id' => $post->id,
                'content' => $comment->content,
                'liked_count' => $comment->liked->count(),
                'replies_count' => $comment->replies->count(),
                'liked' => auth()->user()->likeComment->contains($comment->id),
                'image' => $comment->profile->profileImage(),
                'edit' => false,
                'add_reply' => false,
                'username' => $comment->profile->user->username,
                "route" => route('profile.show', $comment->profile->user->username),
                'replies' => $comment->replies()->get()->map(function ($reply) use ($comment) {
                return [
                    'id' => $reply->id,
                    'content' => $reply->content,
                    'comment_id' => $comment->id,
                    'liked' => auth()->user()->likeReply->contains($reply->id),
                    'image' => $reply->profile->profileImage(),
                    'edit' => false,
                    'username' => $reply->profile->user->username,
                    "liked_count" => $reply->liked->count(),
                    "route" => route('profile.show', $reply->profile->user->username)
                ];
            })->values()->all(),
            ];
        })->values()->all();
       return $comments ;

    }

    public function store(Request $request, Post $post)
    {
        $profid = auth()->user()->profile->id;
        $comment = $post->comments()->create([
            'content' => $request['params']['content'],
            'profile_id' => $profid,
        ]);
        return $comment->id;
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'content' => $request['content']
        ]);
        return 'Successful Updating';
    }

    public function destroy(Comment $comment)
    {
        $comment->replies()->delete();
        $comment->delete();
        return 'Successful Destroying';
    }
}
