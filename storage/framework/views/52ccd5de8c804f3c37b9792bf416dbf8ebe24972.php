<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-7">
                <img src="<?php echo e($_post->postImage($_post->type)); ?>" class="w-100">
            </div>

            <div class="col-5">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">

                            <img src="<?php echo e($_post->user->profile->profileImage()); ?>" class="rounded-circle w-100"
                                 style="max-width: 40px">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a href="
                                    <?php echo e(route('profile.show',['profile'=>$_post->user->username])); ?>">
                                    <span class="text-dark"><?php echo e($_post->user->username); ?></span></a>
                                <?php if(auth()->guard()->guest()): ?>
                                <?php else: ?>
                                <?php if(auth()->user()->id!=$_post->user->id): ?>
                                    <span class="pr-1 pl-1">•</span>


                                        <follow-button user-id="<?php echo e($_post->user->id); ?>"
                                                       follows="<?php echo e($follows); ?>"></follow-button>
                                <?php endif; ?>
                                <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$_post->user->profile)): ?>
                                    <form class="d-inline" action="<?php echo e(route('post.destroy',['post'=>$_post])); ?>"
                                          method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('delete'); ?>
                                        <button class="btn btn-danger " type="submit"><i class="fas fa-trash"></i>
                                        </button>
                                        <a href="<?php echo e(route('post.edit',['post'=>$_post])); ?>"><i class="fas fa-pen"></i></a>

                                    </form>
                                <?php endif; ?>
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

                        <?php if(auth()->guard()->guest()): ?>
                            <?php else: ?>
                        <like-button post-id="<?php echo e($_post->id); ?>" likes="<?php echo e($liked); ?>" count="<?php echo e($likes); ?>"></like-button>
                            <?php endif; ?>
                    </p>

                </div>
                <?php if(auth()->guard()->guest()): ?>
                    <comment post-id="<?php echo e($_post->id); ?>" post-owner="<?php echo e($_post->user->username); ?>"
                             username="<?php echo e(null); ?>"
                             image="<?php echo e(null); ?>"
                             route="<?php echo e(null); ?>"></comment>
                    <?php else: ?>
                    <comment post-id="<?php echo e($_post->id); ?>" post-owner="<?php echo e($_post->user->username); ?>"
                             username="<?php echo e(auth()->user()->username); ?>"
                             image="<?php echo e(auth()->user()->profile->profileImage()); ?>"
                             route="<?php echo e(route("profile.show",auth()->user()->username)); ?>"></comment>
                    <?php endif; ?>


            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/posts/show.blade.php ENDPATH**/ ?>