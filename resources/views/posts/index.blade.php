@extends('layouts.app')
@section('content')
    <div class="container">
        <post></post>
        @foreach($posts as $_post)
            <div class="row ">
                <div class="col-6 offset-3">
                    @if($_post->type->name=='video')
                        <v-player source="{{asset($_post->resource)}}"></v-player>
{{--                        <video width="320" height="240"--}}
{{--                               controls="controls" class="w-100 ">--}}
{{--                            <source src="{{$_post->resource}}" type="video/mp4">--}}
{{--                            <source src="{{$_post->resource}}" type="video/ogg">--}}
{{--                            <source src="{{$_post->resource}}" type="video/webm">--}}
{{--                            Your browser does not support the video tag.--}}
{{--                        </video>--}}

                    @elseif($_post->type->name=='audio')
                        <vue-audio source="{{asset($_post->resource)}}"></vue-audio>
{{--                        <audio controls>--}}
{{--                            <source src="{{$_post->resource}}" type="audio/ogg">--}}
{{--                            <source src="{{$_post->resource}}" type="audio/mpeg">--}}
{{--                            <source src="{{$_post->resource}}" type="audio/wav">--}}
{{--                            <source src="{{$_post->resource}}" type="audio/mp3">--}}
{{--                        </audio>--}}

                    @elseif($_post->type->name=='image')
                        <a href="{{route('post.show',['post'=>$_post->id])}}">
                            <img src="{{$_post->postImage($_post->type)}}" class="w-100">

                        </a>
                    @else
                        <a href="{{$_post->resource}}">
                            <img src="{{$_post->postImage($_post->type)}}" class="w-100">

                        </a>
                    @endif


                </div>
            </div>
            <div class="row pt-2 pb-4">
                <div class="col-6 offset-3">
                    <div>
                        <p>
                            <img src="{{$_post->user->profile->profileImage()}}" class="rounded-circle mr-2"
                                 style="max-height:30px; max-width:30px;">
                            <span class="font-weight-bold"><a href="
                                    {{route('profile.show',['profile'=>$_post->user->username])}}">
                                <span class="text-dark">{{$_post->user->username}}</span>
                            </a>
                        </span>
                            {{$_post->caption}}
                            <like-button like-id="{{$_post->id}}" likes="{{auth()->user()->like->contains($_post->id)}}"
                                         count="{{$_post->liked->count()}}" store-route="/like/">
                            </like-button>
                        </p>


                    </div>
                </div>
                <div class="col-6 offset-3">


                    <comment post-id="{{$_post->id}}" post-owner="{{$_post->user->username}}"
                             username="{{auth()->user()->username}}"
                             image="{{auth()->user()->profile->profileImage()}}"
                             route="{{route("profile.show",auth()->user()->username)}}"></comment>
                    {{--                    <i class="far fa-comment pl-2"></i>--}}
                    {{--                    <span>{{$_post->commentsCount()}}</span>--}}

                </div>
            </div>


        @endforeach
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <!--Creates Pagination Links-->
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
