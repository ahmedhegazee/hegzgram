@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{$user->profile->profileImage()}}" class="rounded-circle " style="max-height:150px; ">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h1>{{$user->username}}</h1>
                    @can('update',$user->profile)
                        <a href="{{route('post.create')}}">Add New Post</a>
                    @endcan
                </div>
                @can('update',$user->profile)
                    <a href="{{route('profile.edit',['profile'=>Auth::user()->username])}}">Edit Profile </a>
                @endcan
                <div class="d-flex">
                    <div class="pr-5"><strong>{{$user->posts->count()}}</strong> posts</div>
                    <div class="pr-5"><strong>{{$user->profile->followers->count()}}</strong> followers</div>
                    <div class="pr-5"><strong>{{$user->following->count()}}</strong> following</div>
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
