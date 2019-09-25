@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($followings as $following)
            <div class="row pb-3 ">
<div class="col-3">
    <img src="{{$following->profileImage()}}" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

    <a href="{{route('profile.show',['profile'=>$following->user->username])}}">{{$following->user->username}}</a>

</div>
                        <div class="col-3">
                            @if(!auth()->guest())

                                <follow-button user-id="{{$following->user->id}}" follows="{{auth()->user()->following->contains($following->user->id)}}"></follow-button>

                            @endif
                        </div>
            </div>
        @endforeach

    </div>@endsection
