@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="{{$_post->postImage()}}" class="w-100">
            </div>

            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="{{$_post->user->profile->profileImage()}}" class="rounded-circle w-100"
                                 style="max-width: 40px">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a  href="
                                    {{route('profile.show',['profile'=>$_post->user->username])}}">
                                    <span class="text-dark">{{$_post->user->username}}</span></a>
                                <span class="pr-1 pl-1">•</span>
                                <follow-button user-id="{{$_post->user->id}}" follows="{{$follows}}"></follow-button>
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
                        <like-button post-id="{{$_post->id}}" likes="{{$liked}}" count="{{$likes}}"></like-button>
                    </p>


                </div>
            </div>
        </div>
    </div>
@endsection