<?php $__env->startSection('content'); ?>
    <div class="container">
        <post></post>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row ">
                <div class="col-6 offset-3">
                    <?php if($_post->type->name=='video'): ?>
                        <v-player source="<?php echo e(asset($_post->resource)); ?>"></v-player>








                    <?php elseif($_post->type->name=='audio'): ?>
                        <vue-audio source="<?php echo e(asset($_post->resource)); ?>"></vue-audio>







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
                            <img src="<?php echo e($_post->user->profile->profileImage()); ?>" class="rounded-circle mr-2"
                                 style="max-height:30px; max-width:30px;">
                            <span class="font-weight-bold"><a href="
                                    <?php echo e(route('profile.show',['profile'=>$_post->user->username])); ?>">
                                <span class="text-dark"><?php echo e($_post->user->username); ?></span>
                            </a>
                        </span>
                            <?php echo e($_post->caption); ?>

                            <like-button like-id="<?php echo e($_post->id); ?>" likes="<?php echo e(auth()->user()->like->contains($_post->id)); ?>"
                                         count="<?php echo e($_post->liked->count()); ?>" store-route="/like/">
                            </like-button>
                        </p>


                    </div>
                </div>
                <div class="col-6 offset-3">


                    <comment post-id="<?php echo e($_post->id); ?>" post-owner="<?php echo e($_post->user->username); ?>"
                             username="<?php echo e(auth()->user()->username); ?>"
                             image="<?php echo e(auth()->user()->profile->profileImage()); ?>"
                             route="<?php echo e(route("profile.show",auth()->user()->username)); ?>"></comment>
                    
                    

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