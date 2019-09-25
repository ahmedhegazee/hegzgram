<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="<?php echo e($user->profile->profileImage()); ?>" class="rounded-circle " style="max-height:150px; ">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h1><?php echo e($user->username); ?></h1>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$user->profile)): ?>
                        <a href="<?php echo e(route('post.create')); ?>">Add New Post</a>
                    <?php endif; ?>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$user->profile)): ?>
                    <a href="<?php echo e(route('profile.edit',['profile'=>Auth::user()->username])); ?>">Edit Profile </a>
                <?php endif; ?>
                <div class="d-flex">
                    <div class="pr-5"><strong><?php echo e($user->posts->count()); ?></strong> posts</div>
                    <div class="pr-5"><strong><?php echo e($user->profile->followers->count()); ?></strong> followers</div>
                    <div class="pr-5"><strong><?php echo e($user->following->count()); ?></strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold"><?php echo e($user->profile->title); ?></div>
                <div><?php echo e($user->profile->description); ?></div>
                <div class="font-weight-bold"><a href="<?php echo e($user->profile->url); ?>"><?php echo e($user->profile->url); ?> <!--//?? 'N/A'}}--></a></div>
            </div>
            <div class="row pt-5">

                <?php $__currentLoopData = $user->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4 pb-5">
                        <a href="<?php echo e(route('post.show',['post'=>$postusername])); ?>">
                            <img src="/storage/<?php echo e($post->image); ?>" class="w-100">
                        </a>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/home.blade.php ENDPATH**/ ?>
