@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{$user->profile->profileImage()}}" class="rounded-circle " style="max-height:150px; ">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4">{{$user->username}}</div>
                        @if(!auth()->guest())
                            @if(Route::current()->originalParameter('profile')!= auth()->user()->username)
                        <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                    @endif
                            @endif
                    </div>
                    @can('update',$user->profile)
                        <a href="{{route('post.create')}}">Add New Post</a>
                    @endcan
                </div>
                @can('update',$user->profile)
                    <a href="{{route('profile.edit',['profile'=>Auth::user()->username])}}">Edit Profile </a>
                @endcan
                <div class="d-flex">
                    <div class="pr-5"><strong>{{$postsCount}}</strong> posts</div>
                    <div class="pr-5"><strong>{{ $followersCount}}</strong> followers</div>
                    <div class="pr-5"><strong>{{$followeringsCount}}</strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
                <div>{{$user->profile->description}}</div>
                <div class="font-weight-bold"><a href="{{$user->profile->url }}">{{$user->profile->url }} <!--//?? 'N/A'}}--></a></div>
            </div>
            <div class="row pt-5">

                @foreach($user->posts as $post)
                    <div class="col-4 pb-5">
                        <a href="{{route('post.show',['post'=>$post->id])}}">
                            <img src="/storage/{{$post->image}}" class="w-100">
                        </a>

                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endsection
