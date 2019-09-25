<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Create Your Profile')); ?></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('profile.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Title')); ?></label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control <?php if ($errors->has('title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('title'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="title" value="<?php echo e(old('title')); ?>" required autocomplete="title" autofocus>

                                    <?php if ($errors->has('title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('title'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Url')); ?></label>

                                <div class="col-md-6">
                                    <input id="url" type="url" class="form-control <?php if ($errors->has('url')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('url'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="url" value="<?php echo e(old('url')); ?>" required autocomplete="url">

                                    <?php if ($errors->has('url')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('url'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right"><?php echo e(__('image')); ?></label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control  <?php if ($errors->has('image')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('image'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="image" required >

                                    <?php if ($errors->has('image')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('image'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Description')); ?></label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                              style="max-height: 130px;height: 130px;min-height: 130px"
                                              class="form-control <?php if ($errors->has('description')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('description'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="description"  required autocomplete="description" autofocus>
                                   <?php echo e(old('description')); ?>

                                    </textarea>

                                    <?php if ($errors->has('description')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('description'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('Create Profile')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/profile/create.blade.php ENDPATH**/ ?>