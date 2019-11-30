@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('comment.store',['post'=>$post->id])}}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Add New Comment</h2>
                    </div>
                    @include('layouts.form')
                    <div class="row pt-4">
                        <button class="btn btn-primary">Add New Comment</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
