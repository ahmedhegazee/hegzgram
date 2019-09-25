<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('post.store')); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Add New Post</h2>
                    </div>
                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label ">Post Caption</label>

                        <input id="caption" type="text"
                               class="form-control <?php if ($errors->has('caption')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('caption'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="caption"
                               value="<?php echo e(old('caption')); ?>" required autocomplete="caption" autofocus>

                        <?php if ($errors->has('caption')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('caption'); ?>
                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                    </div>
                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label ">Post Image</label>
                        <input type="file" class="form-control-file" required id="image" name="image">

                        <?php if ($errors->has('image')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('image'); ?>
                        <strong><?php echo e($message); ?></strong>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                    </div>
                    <div class="row pt-4">
                        <button class="btn btn-primary">Add New Post</button>
                    </div>
                </div>
            </div>
            <?php echo csrf_field(); ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/posts/create.blade.php ENDPATH**/ ?>