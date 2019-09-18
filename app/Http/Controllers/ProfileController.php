<?php

namespace App\Http\Controllers;

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
        $user =User::where('username',$profile)->get();
        $user=$user[0];
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
        $user =User::where('username',$profile)->get();

        //$user = $profile;
        //dd($user[0]->id);
        $user=$user[0];
        //this for the following button to check if this profile is followed or not
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
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
        return view('profile.show',
            compact(
                'user',
                'follows',
                'followeringsCount',
                'followersCount',
                'postsCount'
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
        $data['image'] = $imagePath;
        //add user id when you create new record in post table
        auth()->user()->profile->create($data);
        //Post::create($data);
        // dd(request()->all());
        return redirect(route('profile.show', ['profile' => auth()->user()->username]));

    }
}
