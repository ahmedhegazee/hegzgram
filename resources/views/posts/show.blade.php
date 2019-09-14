@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{$_post->image}}" class="w-100">
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
                                    {{route('profile.show',['profile'=>$_post->user->id])}}">
                                    <span class="text-dark">{{$_post->user->username}}</span></a>
                                <span class="pr-1 pl-1">•</span>
                                <a href="#" >Follow</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <p>
                        <span class="font-weight-bold"><a href="
                                    {{route('profile.show',['profile'=>$_post->user->id])}}">
                                <span class="text-dark">{{$_post->user->username}}</span>
                            </a>
                        </span>
                        {{$_post->caption}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
