@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('comment.store',['post'=>$post->id])}}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Add New Comment</h2>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label ">Comment Content</label>

                        <input id="content" type="text"
                               class="form-control @error('content') is-invalid @enderror" name="content"
                               value="{{ old('content') }}" required autocomplete="content" autofocus>

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="row pt-4">
                        <button class="btn btn-primary">Add New Comment</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
