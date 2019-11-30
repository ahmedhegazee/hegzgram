<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{


    public function edit( $profile)
    {
        //$user = $profile;
        $user =User::where('username',$profile)->get();
        $user=$user[0];
        //to authorize update operation to let only the current user to update his profile
        $this->authorize('update', $user->profile);
        return view('profile.edit',
            compact('user')
        );
    }

    public function update( $profile)
    {
        $user =User::where('username',$profile)->first();

        //to authorize update operation to let only the current user to update his profile
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string',],
            'url' => ['url',],
            'image' => ['image',],
        ]);
        if (request('image')) {
            if (isset($profile->profile->image)) {
                unlink(public_path("storage/" . $profile->profile->image));

            }

            //storing the image in uploads directory in public drive
            $imagePath = request('image')->store('profile', 'public');
            //public_path() find the file directory
            //fit is to cut with required sizes
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        //store the image path in image field in data array
        //update profile image
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect(route('profile.show', ['profile' => auth()->user()->username]));
    }

    public function show( $profile)
    {
        //$user = User::findOrFail($profile);
        // get user by using username
        $user =User::where('username',$profile)->first();
//        dd($profile);
//dd($user);
        //$user = $profile;
        //dd($user[0]->id);
        if(!auth()->guest()){
            //this for the following button to check if this profile is followed or not
            $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
//        $friend = (auth()->user()) ? auth()->user()->friends->contains($user->id) : false;
            $friend=auth()->user()->friends->contains($user->id);
            if($friend)
                $accept=auth()->user()->friends()->where('profile_id',$user->id)->first()->pivot->status;
            else
                $accept=false;
        }
        else{
            $follows=0;
            $friend=0;
            $accept=0;
        }

        //dd($follows);
//        $postsCount = Cache::remember('count.posts.' . $user->id, function () use ($user) {
//            return $user->posts->count();
//        });
        //create cache to make the counting queries is more less

        $postsCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->posts->count();
        });
        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });
        $followeringsCount = Cache::remember(
            'count.followings.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });
        $friendsCount = Cache::remember(
            'count.friends.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->friends()->where('status',1)->count();
            });
        $posts=$user->posts()->paginate(15);
        return view('profile.show',
            compact(
                'user',
                'follows',
                'followeringsCount',
                'followersCount',
                'postsCount',
                'posts',
                'friend',
                'accept',
                'friendsCount'
            )
        );
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string',],
            'url' => ['url',],
            'image' => ['required', 'image',],
        ]);
        //storing the image in uploads directory in public drive
        $imagePath = request('image')->store('profile', 'public');
        //public_path() find the file directory
        //fit is to cut with required sizes
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
        $image->save();
        //store the image path in image field in data array
        $data['image'] = "/storage/".$imagePath;
        //add user id when you create new record in post table
        auth()->user()->profile->create($data);
        //Post::create($data);
        // dd(request()->all());
        return redirect(route('profile.show', ['profile' => auth()->user()->username]));

    }

    public function followers($profile)
    {
        $user =User::where('username',$profile)->get();
        //dd($user);
        $followers = $user[0]->profile->followers;
//        dd($followers->toArray());
        return view('profile.followers',compact('followers'));
    }
    public function followings($profile)
    {
        $user =User::where('username',$profile)->get();
        //dd($user);
        $followings = $user[0]->following;
//        dd($followers->toArray());
        return view('profile.followings',compact('followings'));
    }

    public function friends(Profile $profile)
    {
       $friends =Friend::where('user_id',$profile->id)->where('status',1)->with('profile')->get();
       $friends =$friends->concat(Friend::where('profile_id',$profile->id)->where('status',1)->with('user')->get());

//        $friends=$profile->friends()->where('status',1)->get();
//
//        $friends=$friends->concat($profile->user->friends()->where('status',1)->get());
//        dd($friends);

//        dd($profile->user->friends()->where('status',1)->get());
        $waitings=Friend::where('status',0)->where('profile_id',$profile->id)->with('profile')->get();
        return view('profile.friends',compact('friends','waitings','profile'));
        }
}
