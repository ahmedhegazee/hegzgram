<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="<?php echo e($_post->postImage()); ?>" class="w-100">
            </div>

            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="<?php echo e($_post->user->profile->profileImage()); ?>" class="rounded-circle w-100"
                                 style="max-width: 40px">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a  href="
                                    <?php echo e(route('profile.show',['profile'=>$_post->user->username])); ?>">
                                    <span class="text-dark"><?php echo e($_post->user->username); ?></span></a>
                                <span class="pr-1 pl-1">•</span>
                                <follow-button user-id="<?php echo e($_post->user->id); ?>" follows="<?php echo e($follows); ?>"></follow-button>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <p>
                        <span class="font-weight-bold"><a href="
                                    <?php echo e(route('profile.show',['profile'=>$_post->user->username])); ?>">
                                <span class="text-dark"><?php echo e($_post->user->username); ?></span>
                            </a>
                        </span>
                        <?php echo e($_post->caption); ?>

                        <like-button post-id="<?php echo e($_post->id); ?>" likes="<?php echo e($liked); ?>" count="<?php echo e($likes); ?>"></like-button>
                    </p>

                </div>
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row ">
                      <p>
                           <img src="<?php echo e($comment->profile->profileImage()); ?>" class="rounded-circle w-100"
                                style="max-width: 30px">
                           <span class="font-weight-bold">
                            <a href="<?php echo e(route('profile.show',['profile'=>$comment->profile->user->username])); ?>">
                                <span class="text-dark"><?php echo e($comment->profile->user->username); ?></span>
                            </a>
                        </span> <span><?php echo e($comment->content); ?></span>


                      </p>



                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('comment.create',['post'=>$_post->id])); ?>" class="btn btn-primary">Add Comment</a>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/posts/show.blade.php ENDPATH**/ ?>