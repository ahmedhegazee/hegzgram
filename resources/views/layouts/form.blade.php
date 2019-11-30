<div class="form-group row">
    <label for="content" class="col-md-4 col-form-label "> Content</label>
    <input id="content" type="text"
           class="form-control @error('content') is-invalid @enderror" name="content"
           value="{{ $content??old('content') }}" required autocomplete="content" autofocus>

    @error('content')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror

</div>
