<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Profile;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{


    public function edit($profile)
    {
        //$user = $profile;
        $user = User::where('username', $profile)->get();
        $user = $user[0];
        //to authorize update operation to let only the current user to update his profile
        $this->authorize('update', $user->profile);
        return view('profile.edit',
            compact('user')
        );
    }

    public function update($profile)
    {
        $user = User::where('username', $profile)->first();

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

    public function show($profile)
    {
        // get user by using username
        $user = User::where('username', $profile)->first();

        if (!auth()->guest()) {
            //this for the following button to check if this profile is followed or not
            $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
//        $friend = (auth()->user()) ? auth()->user()->friends->contains($user->id) : false;
//            $friend = auth()->user()->getFriends()->contains($user->id);
            $friend = auth()->user()->hasFriendRequest($user);
//            dd($friend);
            if ($friend)
//                $accept = auth()->user()->friendsOfMine()->where('friend_id', $user->id)->first()->pivot->status;
                $accept = auth()->user()->getFriends()->contains($user->id);
            else
                $accept = false;
        } else {
            $follows = 0;
            $friend = 0;
            $accept = 0;
        }
//dd($accept);
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
                return $user->followers->count();
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
                return $user->getFriends()->count();
            });
        $posts = $user->posts()->paginate(15);
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
        $data['image'] = "/storage/" . $imagePath;
        //add user id when you create new record in post table
        auth()->user()->profile->create($data);
        //Post::create($data);
        // dd(request()->all());
        return redirect(route('profile.show', ['profile' => auth()->user()->username]));

    }

    public function preparingData(Collection $collection)
    {
        return $collection->map(function ($friend) {
            $check = auth()->user()->hasFriendRequest($friend);
            if ($check)
                return [
                    'id' => $friend->id,
                    'userId' => $friend->id,
                    'username' => $friend->username,
                    'url' => route('profile.show', $friend->username),
                    'image' => $friend->profile->profileImage(),
                    'friend' => $check,
                    'accept' => auth()->user()->getFriends()->contains("id", $friend->id),
                    'follows' => auth()->user()->following->contains($friend->id),
                ];
            else
                return [
                    'id' => $friend->id,
                    'userId' => $friend->id,
                    'username' => $friend->username,
                    'url' => route('profile.show', $friend->username),
                    'image' => $friend->profile->profileImage(),
                    'friend' => $check,
                    'follows' => auth()->user()->following->contains($friend->id),
                    'accept' => false,
                ];
        })->values()->all();
    }
    public function followers(Profile $profile)
    {
//        $followers = $profile->followers()
//            ->get()->map(function ($follower) {
//                return [
//                    'id' => $follower->id,
//                    'userId' => $follower->id,
//                    'username' => $follower->username,
//                    'url' => route('profile.show', $follower->username),
//                    'image' => $follower->profile->profileImage(),
//                    'follows' => auth()->user()->following->contains($follower->id)
//
//                ];
//            })->values()->all();
        $followers = $this->preparingData($profile->user->followers()->get());
        return response()->json($followers);
    }

    public function followings(Profile $profile)
    {
//        $followings = $profile->user->following()->get()->map(function ($following) {
//            return [
//                'id' => $following->id,
//                'userId' => $following->id,
//                'username' => $following->user->username,
//                'url' => route('profile.show', $following->user->username),
//                'image' => $following->profileImage(),
//                'follows' => auth()->user()->following->contains($following->id)
//            ];
//        })->values()->all();
        $followings = $this->preparingData($profile->user->following()->get());
        return response()->json($followings);
    }

    public function friends(Profile $profile)
    {
//        dd($profile->user->getFriends());
//        $friends = $profile->user->getFriends()->map(function ($friend) use ($profile) {
//            $check = auth()->user()->hasFriendRequest($friend);
//            if ($check)
//                return [
//                    'id' => $friend->id,
//                    'userId' => $friend->id,
//                    'username' => $friend->username,
//                    'url' => route('profile.show', $friend->username),
//                    'image' => $friend->profile->profileImage(),
//                    'friend' => $check,
//                    'accept' => auth()->user()->getFriends()->contains("id", $friend->id),
//                ];
//            else
//                return [
//                    'id' => $friend->id,
//                    'userId' => $friend->id,
//                    'username' => $friend->username,
//                    'url' => route('profile.show', $friend->username),
//                    'image' => $friend->profile->profileImage(),
//                    'friend' => $check,
//                    'accept' => false,
//                ];
//
//        })->values()->all();
//        $waitings = $profile->user->getPendingFriendRequests();
//        return view('profile.friends', compact('friends', 'waitings', 'profile'));
        $friends = $this->preparingData($profile->user->getFriends());
        return response()->json($friends);
    }
}
