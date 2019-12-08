<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOption\Tests\SomeTest;

class CommentsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @param Post $post
     * @return Response
     */

    public function show(Post $post)
    {
        $data=$this->getComments($post);

        return response()->json($data);
    }

    public function deletingUnRequiredFields(&$variable)
    {
        unset($variable['created_at']);
        unset($variable['updated_at']);
        unset($variable['profile_id']);
        unset($variable['profile']);


    }

    public function preparingReply($reply)
    {
        if(auth()->user()!=null)
        $reply['liked'] = auth()->user()->likeReply->contains(intval($reply['id']));
        else
            $reply['liked']=false;
        $r = Reply::find(intval($reply['id']));
        $user = User::find(intval($reply['profile_id']));
        $reply['image'] = $user->profile->profileImage();
        $reply['edit'] = false;

        $reply["username"] = $user->username;
        $reply['liked_count'] = $r->liked->count();
        $reply["route"] = route('profile.show', $user->username);
        $this->deletingUnRequiredFields($reply);

        return $reply;
    }

    public function preparingComment($comment)
    {
        if(auth()->user()!=null)
        $comment['liked'] = auth()->user()->likeComment->contains(intval($comment['id']));
        else
            $comment['liked']=false;
        $user = User::find(intval($comment['profile']['user_id']));
        $comment['image'] = $comment['profile']['image'];
        $comment['add_reply'] = false;
        $comment["username"] = $user->username;
        $comment['edit'] = false;
        $comment["route"] = route('profile.show', $user->username);
        $this->deletingUnRequiredFields($comment);
        return $comment;
    }

    public function getComments(Post $post)
    {
        $comments = $post->comments()->with('profile')->withCount('liked')->withCount('replies')->with('replies')->get()->toArray();
        $data = [];
        foreach ($comments as $comment) {

            $comment = $this->preparingComment($comment);
            $replies = [];

            foreach ($comment['replies'] as $reply) {
                $reply = $this->preparingReply($reply);
                array_push($replies, $reply);
            }


            $comment['replies'] = $replies;
            array_push($data, $comment);
        }
        return $data;
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
