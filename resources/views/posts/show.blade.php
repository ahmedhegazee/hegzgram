@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-7">
                <img src="{{$_post->postImage($_post->type)}}" class="w-100">
            </div>

            <div class="col-5">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">

                            <img src="{{$_post->user->profile->profileImage()}}" class="rounded-circle w-100"
                                 style="max-width: 40px">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a href="
                                    {{route('profile.show',['profile'=>$_post->user->username])}}">
                                    <span class="text-dark">{{$_post->user->username}}</span></a>
                                @guest
                                @else
                                @if(auth()->user()->id!=$_post->user->id)
                                    <span class="pr-1 pl-1">•</span>


                                        <follow-button user-id="{{$_post->user->id}}"
                                                       follows="{{$follows}}"></follow-button>
                                @endif
                                @endguest

                            @can('update',$_post->user->profile)
                                    <form class="d-inline" action="{{route('post.destroy',['post'=>$_post])}}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger " type="submit"><i class="fas fa-trash"></i>
                                        </button>
                                        <a href="{{route('post.edit',['post'=>$_post])}}"><i class="fas fa-pen"></i></a>

                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <hr>

                    <p>
                        <span class="font-weight-bold"><a href="
                                    {{route('profile.show',['profile'=>$_post->user->username])}}">
                                <span class="text-dark">{{$_post->user->username}}</span>
                            </a>
                        </span>
                        {{$_post->caption}}
                        @guest
                            @else
                        <like-button post-id="{{$_post->id}}" likes="{{$liked}}" count="{{$likes}}"></like-button>
                            @endguest
                    </p>

                </div>
                @guest
                    <comment post-id="{{$_post->id}}" post-owner="{{$_post->user->username}}"
                             username="{{null}}"
                             image="{{null}}"
                             route="{{null}}"></comment>
                    @else
                    <comment post-id="{{$_post->id}}" post-owner="{{$_post->user->username}}"
                             username="{{auth()->user()->username}}"
                             image="{{auth()->user()->profile->profileImage()}}"
                             route="{{route("profile.show",auth()->user()->username)}}"></comment>
                    @endguest


            </div>
        </div>
    </div>
@endsection
