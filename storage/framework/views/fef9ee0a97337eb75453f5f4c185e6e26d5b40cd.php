<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Edit Profile')); ?></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('profile.update',['profile'=>Auth::user()->username])); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Title')); ?></label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control <?php if ($errors->has('title')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('title'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="title" value="<?php echo e(old('title')??$user->profile->title); ?>" required autocomplete="title" autofocus>

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
                                <label for="url" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Url')); ?></label>

                                <div class="col-md-8">
                                    <input id="url" type="url" class="form-control <?php if ($errors->has('url')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('url'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="url" value="<?php echo e(old('url')??$user->profile->url); ?>" required autocomplete="url">

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
                                <label for="image" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Profile Image')); ?></label>

                                <div class="col-md-8">
                                    <input id="image" type="file" class="form-control  <?php if ($errors->has('image')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('image'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="image"  >

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
                                <label for="description" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Description')); ?></label>

                                <div class="col-md-8">
                                    <textarea id="description"
                                              style="max-height: 130px;height: 130px;min-height: 130px"
                                              class="form-control <?php if ($errors->has('description')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('description'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="description"  required autocomplete="description" autofocus><?php echo e(old('description')??$user->profile->description); ?>

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
                                        <?php echo e(__('Update Profile')); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/profile/edit.blade.php ENDPATH**/ ?>