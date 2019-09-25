<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php $__currentLoopData = $followings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $following): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row pb-3 ">
<div class="col-3">
    <img src="<?php echo e($following->profileImage()); ?>" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

    <a href="<?php echo e(route('profile.show',['profile'=>$following->user->username])); ?>"><?php echo e($following->user->username); ?></a>

</div>
                        <div class="col-3">
                            <?php if(!auth()->guest()): ?>

                                <follow-button user-id="<?php echo e($following->user->id); ?>" follows="<?php echo e(auth()->user()->following->contains($following->user->id)); ?>"></follow-button>

                            <?php endif; ?>
                        </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/profile/followings.blade.php ENDPATH**/ ?>