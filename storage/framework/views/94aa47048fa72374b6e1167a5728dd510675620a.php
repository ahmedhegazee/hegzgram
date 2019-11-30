<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php $__currentLoopData = $followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row pb-3 ">

                    <img src="<?php echo e($follower->profile->profileImage()); ?>" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

               <a href="<?php echo e(route('profile.show',['profile'=>$follower->username])); ?>"><?php echo e($follower->username); ?></a>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
































<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/profile/followers.blade.php ENDPATH**/ ?>