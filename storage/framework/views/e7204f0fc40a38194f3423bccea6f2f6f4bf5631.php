<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('reply.update',['comment'=>$comment,'reply'=>$reply])); ?>" method="post" enctype="multipart/form-data">
            <?php echo method_field('put'); ?>
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Update Reply</h2>
                    </div>
                   <?php echo $__env->make('layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="row pt-4">
                        <button class="btn btn-primary">Update Reply</button>
                    </div>
                </div>
            </div>
            <?php echo csrf_field(); ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/reply/edit.blade.php ENDPATH**/ ?>