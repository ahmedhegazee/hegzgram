@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($followers as $follower)
        <div class="row pb-3 ">

                    <img src="{{$follower->profile->profileImage()}}" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

               <a href="{{route('profile.show',['profile'=>$follower->username])}}">{{$follower->username}}</a>

        </div>
        @endforeach

    </div>
{{--            <div class="col-9 pt-5">--}}
{{--                <div class="d-flex justify-content-between align-items-baseline">--}}
{{--                    <div class="d-flex align-items-center pb-3">--}}
{{--                        <div class="h4">{{$user->username}}</div>--}}
{{--                        @if(!auth()->guest())--}}
{{--                            @if(Route::current()->originalParameter('profile')!= auth()->user()->username)--}}
{{--                        <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>--}}
{{--                    @endif--}}
{{--                            @endif--}}
{{--                    </div>--}}
{{--                    @can('update',$user->profile)--}}
{{--                        <a href="{{route('post.create')}}">Add New Post</a>--}}
{{--                    @endcan--}}
{{--                </div>--}}
{{--                @can('update',$user->profile)--}}
{{--                    <a href="{{route('profile.edit',['profile'=>Auth::user()->username])}}">Edit Profile </a>--}}
{{--                @endcan--}}
{{--                <div class="d-flex">--}}
{{--                    <div class="pr-5"><strong>{{$postsCount}}</strong> posts</div>--}}
{{--                    <a href="{{route('profile.followers',['profile'=>Auth::user()->username])}}" class="pr-5"><strong>{{ $followersCount}}</strong> followers</a>--}}
{{--                    <a href="{{route('profile.followings',['profile'=>Auth::user()->username])}}" class="pr-5"><strong>{{$followeringsCount}}</strong> following</a>--}}
{{--                </div>--}}
{{--                <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>--}}
{{--                <div>{{$user->profile->description}}</div>--}}
{{--                <div class="font-weight-bold"><a href="{{$user->profile->url }}">{{$user->profile->url }} <!--//?? 'N/A'}}--></a></div>--}}
{{--            </div>--}}
{{--            --}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
