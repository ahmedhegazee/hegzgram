<template>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="row">
                <h2>Add New Post</h2>
            </div>
            <div class="form-group row">
                <label for="caption" class="col-md-4 col-form-label ">Post Caption</label>

                <input id="caption" type="text"
                       class="form-control @error('caption') is-invalid @enderror" name="caption"
                       value="{{ old('caption') }}" required autocomplete="caption" autofocus>

                @error('caption')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
            <div class="row">
                <label for="resource" class="col-md-4 col-form-label ">Post Image</label>
                <input type="file" class="form-control-file" required id="resource" name="resource">

                @error('resource')
                <strong>{{ $message }}</strong>
                @enderror

            </div>
            <div class="row pt-4">
                <button class="btn btn-primary">Add New Post</button>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "AddNewPost"
    }
</script>

<style scoped>

</style>
