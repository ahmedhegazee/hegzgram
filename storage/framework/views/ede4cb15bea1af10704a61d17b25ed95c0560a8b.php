<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if($waitings->count()>0): ?>
        <h1>Friend Requests List</h1>
        <?php $__currentLoopData = $waitings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waiting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row pb-3 ">
                <div class="col-3">
                    <img src="<?php echo e($waiting->profile->first()->profileImage()); ?>" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

                    <a href="<?php echo e(route('profile.show',['profile'=>$waiting->user->first()->username])); ?>"><?php echo e($waiting->user->first()->name); ?></a>

                </div>
                <div class="col-3">
                                             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$profile)): ?>

                                                    <accept-button profile-id="<?php echo e($waiting->user->first()->id); ?>" ></accept-button>

                                                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
            <?php if($friends->count()>0): ?>
                <h1>Friends List</h1>

                    <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($friend->toArray()['user'])): ?>
                        <div class="row pb-3 ">
                            <div class="col-3">
                                <img src="<?php echo e($friend->user->first()->profile->profileImage()); ?>" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

                                <a href="<?php echo e(route('profile.show',['profile'=>$friend->user->first()->username])); ?>"><?php echo e($friend->user->first()->name); ?></a>

                            </div>
                            <div class="col-3">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$profile)): ?>

                                    <friend-button profile-id="<?php echo e($friend->user->first()->id); ?>" friend="1"
                                                   accept="1"></friend-button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row pb-3 ">
                            <div class="col-3">
                                <img src="<?php echo e($friend->profile->first()->profileImage()); ?>" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">

                                <a href="<?php echo e(route('profile.show',['profile'=>$friend->profile->first()->user->username])); ?>"><?php echo e($friend->profile->first()->user->name); ?></a>

                            </div>
                            <div class="col-3">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$profile)): ?>

                                    <friend-button profile-id="<?php echo e($friend->profile->first()->id); ?>" friend="1"
                                                   accept="1"></friend-button>
                                <?php endif; ?>
                            </div>
                        </div>
                            <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>
    </div><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/profile/friends.blade.php ENDPATH**/ ?>