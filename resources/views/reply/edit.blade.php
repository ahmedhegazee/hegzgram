@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('reply.update',['comment'=>$comment,'reply'=>$reply])}}" method="post" enctype="multipart/form-data">
            @method('put')
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Update Reply</h2>
                    </div>
                   @include('layouts.form')
                    <div class="row pt-4">
                        <button class="btn btn-primary">Update Reply</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
