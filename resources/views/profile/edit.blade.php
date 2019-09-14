@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('profile.update',['profile'=>Auth::user()->id])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title')??$user->profile->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="url" class="col-md-2 col-form-label text-md-right">{{ __('Url') }}</label>

                                <div class="col-md-8">
                                    <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url')??$user->profile->url }}" required autocomplete="url">

                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                                <div class="col-md-8">
                                    <input id="image" type="file" class="form-control  @error('image') is-invalid @enderror" name="image"  >

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-8">
                                    <textarea id="description"
                                              style="max-height: 130px;height: 130px;min-height: 130px"
                                              class="form-control @error('description') is-invalid @enderror" name="description"  required autocomplete="description" autofocus>{{  old('description')??$user->profile->description }}
                                    </textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Profile') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
