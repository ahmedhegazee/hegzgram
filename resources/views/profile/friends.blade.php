@extends('layouts.app')

@section('content')
    <div class="container">
        @if($waitings->count()>0)
        <h1>Friend Requests List</h1>
        @foreach($waitings as $waiting)
            <div class="row pb-3 ">
                <div class="col-3">
                    <img src="{{$waiting->profile->profileImage()}}" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

                    <a href="{{route('profile.show',['profile'=>$waiting->username])}}">{{$waiting->name}}</a>

                </div>
                <div class="col-3">
                                             @can('update',$profile)

                                                    <accept-button profile-id="{{$waiting->id}}" ></accept-button>

                                                @endcan
                </div>
            </div>
        @endforeach
        @endif
            @if($friends->count()>0)
                <h1>Friends List</h1>

                    @foreach($friends as $friend)

                        <div class="row pb-3 ">
                            <div class="col-3">
                                <img src="{{$friend->profile->profileImage()}}" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">
                                <a href="{{route('profile.show',['profile'=>$friend->username])}}">{{$friend->name}}</a>
                            </div>
                            <div class="col-3">
                                @can('update',$profile)

                                    <friend-button profile-id="{{$friend->id}}" friend="1"
                                                   accept="1"></friend-button>
                                @endcan
                            </div>
                        </div>
                    @endforeach

@endif
    </div>@endsection
