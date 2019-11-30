<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row pl-3 mb-2">
            <h2>Update Post</h2>
        </div>
        <form action="<?php echo e(route('post.update',compact('post'))); ?>" method="post" enctype="multipart/form-data">
            <?php echo method_field('put'); ?>
            <div class="row">

                <div class="col-5 ">
                    <img src="<?php echo e($post->postImage()); ?>" style="max-height: 300px" alt="">
                </div>
                <div class="col ">

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label ">Post Caption</label>

                        <textarea id="caption" type="text"
                               class="form-control <?php if ($errors->has('caption')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('caption'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>"
                                  style="min-height: 200px; max-height:200px;
                                  max-width:500px;min-width: 500px;"
                                  name="caption"
                               required  autofocus><?php echo e($post->caption??old('caption')); ?>

                        </textarea>
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
                        <input type="file" class="form-control-file"  id="image" name="image">

                        <?php if ($errors->has('image')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('image'); ?>
                        <strong><?php echo e($message); ?></strong>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                    </div>
                    <div class="row pt-4">
                        <button class="btn btn-primary">Update Post</button>
                    </div>
                </div>

            </div>
            <?php echo csrf_field(); ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/posts/update.blade.php ENDPATH**/ ?>