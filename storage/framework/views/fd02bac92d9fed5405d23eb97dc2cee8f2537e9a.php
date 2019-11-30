<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row ">
            <div class="col-md-3 col-sm-12 p-md-3 p-sm-2 ">
                <img src="<?php echo e($user->profile->profileImage()); ?>" class="rounded-circle" style="max-height:150px; ">
            </div>
            <div class="col-md-9 col-sm-12 pt-md-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4"><?php echo e($user->username); ?></div>
                        <?php if(!auth()->guest()): ?>
                            <?php if(Route::current()->originalParameter('profile')!= auth()->user()->username): ?>
                                <follow-button user-id="<?php echo e($user->id); ?>" follows="<?php echo e($follows); ?>"></follow-button>
                                <friend-button profile-id="<?php echo e($user->profile->id); ?>" friend="<?php echo e($friend); ?>"
                                               accept="<?php echo e($accept); ?>"></friend-button>

                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$user->profile)): ?>
                        <a href="<?php echo e(route('post.create')); ?>">Add New Post</a>

                    <?php endif; ?>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$user->profile)): ?>
                    <a href="<?php echo e(route('profile.edit',['profile'=>Auth::user()->username])); ?>">Edit Profile </a>
                <?php endif; ?>
                <div class="d-flex">
                    <div class="pr-5"><strong><?php echo e($postsCount); ?></strong> posts</div>
                    <a href="<?php echo e(route('profile.followers',['profile'=>$user->username])); ?>"
                       class="pr-5"><strong><?php echo e($followersCount); ?></strong> followers</a>
                    <a href="<?php echo e(route('profile.followings',['profile'=>$user->username])); ?>"
                       class="pr-5"><strong><?php echo e($followeringsCount); ?></strong> following</a>
                    <a href="<?php echo e(route('profile.friends',['profile'=>$user->profile])); ?>"
                       class="pr-5"><strong><?php echo e($friendsCount); ?></strong> friends</a>
                </div>
                <div class="pt-4 font-weight-bold"><?php echo e($user->profile->title); ?></div>
                <div><?php echo e($user->profile->description); ?></div>
                <div class="font-weight-bold"><a
                        href="<?php echo e($user->profile->url); ?>"><?php echo e($user->profile->url); ?> <!--//?? 'N/A'}}--></a></div>
            </div>
            <div class="row pt-5">

                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 col-sm-12 pb-5">
                        <?php if($post->type->name=='video'): ?>
                            <video width="320" height="240" controls="controls" class="w-100">
                                <source src="<?php echo e($post->resource); ?>" type="video/mp4">
                                <source src="<?php echo e($post->resource); ?>" type="video/ogg">
                                <source src="<?php echo e($post->resource); ?>" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                        <?php elseif($post->type->name=='audio'): ?>
                            <audio controls>
                                <source src="<?php echo e($post->resource); ?>" type="audio/ogg">
                                <source src="<?php echo e($post->resource); ?>" type="audio/mpeg">
                                <source src="<?php echo e($post->resource); ?>" type="audio/wav">
                                Your browser does not support the audio tag.
                            </audio>
                        <?php elseif($post->type->name=='image'): ?>
                            <a href="<?php echo e(route('post.show',['post'=>$post->id])); ?>">
                                <img src="<?php echo e($post->postImage($post->type)); ?>" class="w-100">

                            </a>
                            <?php else: ?>
                            <a href="<?php echo e($post->resource); ?>">
                                <img src="<?php echo e($post->postImage($post->type)); ?>" class="w-100">

                            </a>

                        <?php endif; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div><?php echo e($posts->links()); ?></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/profile/show.blade.php ENDPATH**/ ?>