<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('comment.store',['post'=>$post->id])); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Add New Comment</h2>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label ">Comment Content</label>

                        <input id="content" type="text"
                               class="form-control <?php if ($errors->has('content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('content'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="content"
                               value="<?php echo e(old('content')); ?>" required autocomplete="content" autofocus>

                        <?php if ($errors->has('content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('content'); ?>
                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

                    </div>

                    <div class="row pt-4">
                        <button class="btn btn-primary">Add New Comment</button>
                    </div>
                </div>
            </div>
            <?php echo csrf_field(); ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/comment/create.blade.php ENDPATH**/ ?>