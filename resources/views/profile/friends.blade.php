@extends('layouts.app')

@section('content')
    <div class="container">
        @if($waitings->count()>0)
        <h1>Friend Requests List</h1>
        @foreach($waitings as $waiting)
            <div class="row pb-3 ">
                <div class="col-3">
                    <img src="{{$waiting->profile->first()->profileImage()}}" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

                    <a href="{{route('profile.show',['profile'=>$waiting->user->first()->username])}}">{{$waiting->user->first()->name}}</a>

                </div>
                <div class="col-3">
                                             @can('update',$profile)

                                                    <accept-button profile-id="{{$waiting->user->first()->id}}" ></accept-button>

                                                @endcan
                </div>
            </div>
        @endforeach
        @endif
            @if($friends->count()>0)
                <h1>Friends List</h1>

                    @foreach($friends as $friend)
                        @if(isset($friend->toArray()['user']))
                        <div class="row pb-3 ">
                            <div class="col-3">
                                <img src="{{$friend->user->first()->profile->profileImage()}}" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

                                <a href="{{route('profile.show',['profile'=>$friend->user->first()->username])}}">{{$friend->user->first()->name}}</a>

                            </div>
                            <div class="col-3">
                                @can('update',$profile)

                                    <friend-button profile-id="{{$friend->user->first()->id}}" friend="1"
                                                   accept="1"></friend-button>
                                @endcan
                            </div>
                        </div>
                    @else
                        <div class="row pb-3 ">
                            <div class="col-3">
                                <img src="{{$friend->profile->first()->profileImage()}}" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

                                <a href="{{route('profile.show',['profile'=>$friend->profile->first()->user->username])}}">{{$friend->profile->first()->user->name}}</a>

                            </div>
                            <div class="col-3">
                                @can('update',$profile)

                                    <friend-button profile-id="{{$friend->profile->first()->id}}" friend="1"
                                                   accept="1"></friend-button>
                                @endcan
                            </div>
                        </div>
                            @endif
                    @endforeach

@endif
    </div>@endsection
