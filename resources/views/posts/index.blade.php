@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $_post)
            <div class="row ">
                <div class="col-6 offset-3">
                    <a href="{{route('post.show',['post'=>$_post->id])}}">
                        <img src="/storage/{{$_post->image}}" class="w-100">
                    </a>
                </div>
            </div>
            <div class="row pt-2 pb-4">
                <div class="col-6 offset-3">
                    <div>
                        <p>
                        <span class="font-weight-bold"><a href="
                                    {{route('profile.show',['profile'=>$_post->user->username])}}">
                                <span class="text-dark">{{$_post->user->username}}</span>
                            </a>
                        </span>
                            {{$_post->caption}}
                            <like-button post-id="{{$_post->id}}" likes="{{auth()->user()->like->contains($_post->id)}}" count="{{$_post->liked->count()}}"></like-button>
                        </p>
                    </div>
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
