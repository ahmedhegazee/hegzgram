@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pl-3 mb-2">
            <h2>Update Post</h2>
        </div>
        <form action="{{route('post.update',compact('post'))}}" method="post" enctype="multipart/form-data">
            @method('put')
            <div class="row">

                <div class="col-5 ">
                    <img src="{{$post->postImage()}}" style="max-height: 300px" alt="">
                </div>
                <div class="col ">

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label ">Post Caption</label>

                        <textarea id="caption" type="text"
                               class="form-control @error('caption') is-invalid @enderror"
                                  style="min-height: 200px; max-height:200px;
                                  max-width:500px;min-width: 500px;"
                                  name="caption"
                               required  autofocus>{{ $post->caption??old('caption') }}
                        </textarea>
                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label ">Post Image</label>
                        <input type="file" class="form-control-file"  id="image" name="image">

                        @error('image')
                        <strong>{{ $message }}</strong>
                        @enderror

                    </div>
                    <div class="row pt-4">
                        <button class="btn btn-primary">Update Post</button>
                    </div>
                </div>

            </div>
            @csrf
        </form>
    </div>
@endsection
