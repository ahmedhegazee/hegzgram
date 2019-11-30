<?php $__env->startSection('content'); ?>
    <div class="container">
        <post></post>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row ">
                <div class="col-6 offset-3">
                    <?php if($_post->type->name=='video'): ?>
                        <video width="320" height="240" controls="controls" class="w-100">
                            <source src="<?php echo e($_post->resource); ?>" type="video/mp4">
                            <source src="<?php echo e($_post->resource); ?>" type="video/ogg">
                            <source src="<?php echo e($_post->resource); ?>" type="video/webm">
                            Your browser does not support the video tag.
                        </video>

                    <?php elseif($_post->type->name=='audio'): ?>
                        <audio controls>
                            <source src="<?php echo e($_post->resource); ?>" type="audio/ogg">
                            <source src="<?php echo e($_post->resource); ?>" type="audio/mpeg">
                            <source src="<?php echo e($_post->resource); ?>" type="audio/wav">
                            Your browser does not support the audio tag.
                        </audio>
                    <?php elseif($_post->type->name=='image'): ?>
                        <a href="<?php echo e(route('post.show',['post'=>$_post->id])); ?>">
                            <img src="<?php echo e($_post->postImage($_post->type)); ?>" class="w-100">

                        </a>
                    <?php else: ?>
                        <a href="<?php echo e($_post->resource); ?>">
                            <img src="<?php echo e($_post->postImage($_post->type)); ?>" class="w-100">

                        </a>
                    <?php endif; ?>


                </div>
            </div>
            <div class="row pt-2 pb-4">
                <div class="col-6 offset-3">
                    <div>
                        <p>
                            <img src="<?php echo e($_post->user->profile->profileImage()); ?>" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">
                            <span class="font-weight-bold"><a href="
                                    <?php echo e(route('profile.show',['profile'=>$_post->user->username])); ?>">
                                <span class="text-dark"><?php echo e($_post->user->username); ?></span>
                            </a>
                        </span>
                            <?php echo e($_post->caption); ?>

                        </p>
                    </div>
                </div>
                <div class="col-6 offset-3">
                    <like-button like-id="<?php echo e($_post->id); ?>" likes="<?php echo e(auth()->user()->like->contains($_post->id)); ?>"
                                 count="<?php echo e($_post->liked->count()); ?>" store-route="/like/">
                    </like-button>
                    <i class="far fa-comment pl-2"></i>
                    <span><?php echo e($_post->commentsCount()); ?></span>
                </div>
            </div>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <!--Creates Pagination Links-->
                    <?php echo e($posts->links()); ?>

                </div>
            </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/posts/index.blade.php ENDPATH**/ ?>