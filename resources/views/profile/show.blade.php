@extends('layouts.app')
<style>
    .vueAudioBetter{
       width:300px !important;
    }
</style>
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-3 col-sm-12 p-md-3 p-sm-2 ">
                <img src="{{$user->profile->profileImage()}}" class="rounded-circle" style="max-height:150px; ">
            </div>
            <div class="col-md-9 col-sm-12 pt-md-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4">{{$user->username}}</div>
                        @if(!auth()->guest())
                            @if(Route::current()->originalParameter('profile')!= auth()->user()->username)
                                <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                                <friend-button profile-id="{{$user->profile->id}}" friend="{{$friend}}"
                                               accept="{{$accept}}"></friend-button>

                            @endif
                        @endif
                    </div>
                    @can('update',$user->profile)
                        <a href="{{route('post.create')}}">Add New Post</a>

                    @endcan
                </div>

                <div class="d-flex">
                    <div class="pr-5"><strong>{{$postsCount}}</strong> posts</div>
                    <a href="{{route('profile.followers',['profile'=>$user->username])}}"
                       class="pr-5"><strong>{{ $followersCount}}</strong> followers</a>
                    <a href="{{route('profile.followings',['profile'=>$user->username])}}"
                       class="pr-5"><strong>{{$followeringsCount}}</strong> following</a>
                    <a href="{{route('profile.friends',['profile'=>$user->profile])}}"
                       class="pr-5"><strong>{{$friendsCount}}</strong> friends</a>
                </div>
                <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
                <div>{{$user->profile->description}}</div>
                <div class="font-weight-bold"><a
                        href="{{$user->profile->url }}">{{$user->profile->url }} <!--//?? 'N/A'}}--></a></div>
            </div>
            <div class="row pt-5">

                @foreach($posts as $post)
                    <div class="col-md-4 col-sm-12 pb-5">
                        @if($post->type->name=='video')
                            <v-player source="{{asset($post->resource)}}"></v-player>
{{--                            <video width="320" height="240" controls="controls" class="w-100">--}}
{{--                                <source src="{{$post->resource}}" type="video/mp4">--}}
{{--                                <source src="{{$post->resource}}" type="video/ogg">--}}
{{--                                <source src="{{$post->resource}}" type="video/webm">--}}
{{--                                Your browser does not support the video tag.--}}
{{--                            </video>--}}
                        @elseif($post->type->name=='audio')
                            <vue-audio  source="{{asset($post->resource)}}"></vue-audio>

                            {{--                            <audio controls>--}}
{{--                                <source src="{{$post->resource}}" type="audio/ogg">--}}
{{--                                <source src="{{$post->resource}}" type="audio/mpeg">--}}
{{--                                <source src="{{$post->resource}}" type="audio/wav">--}}
{{--                                Your browser does not support the audio tag.--}}
{{--                            </audio>--}}
                        @elseif($post->type->name=='image')
                            <a href="{{route('post.show',['post'=>$post->id])}}">
                                <img src="{{$post->postImage($post->type)}}" class="w-100">

                            </a>
                            @else
                            <a href="{{$post->resource}}">
                                <img src="{{$post->postImage($post->type)}}" class="w-100">

                            </a>

                        @endif

                    </div>
                @endforeach

                <div>{{$posts->links()}}</div>
            </div>
        </div>
    </div>
@endsection
