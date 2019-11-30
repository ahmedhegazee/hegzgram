@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('comment.update',['post'=>$post->id,'comment'=>$comment])}}" method="post" enctype="multipart/form-data">
            @method('put')
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Update Comment</h2>
                    </div>
                    @include('layouts.form')
                    <div class="row pt-4">
                        <button class="btn btn-primary">Update Comment</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
