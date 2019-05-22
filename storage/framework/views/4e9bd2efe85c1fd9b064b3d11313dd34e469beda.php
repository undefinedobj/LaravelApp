<?php $__env->startSection('title', env('APP_NAME')); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2" role="main">

                <?php echo Form::model($discussion, ['url' => '/discussions/'.$discussion->id, 'method' => 'put']); ?>


                <?php echo $__env->make('forum.form', ['discussion' => $discussion], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div>
                    <?php echo Form::submit('更新帖子', ['class' => 'btn btn-primary form-control']); ?>

                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\laravelapp\resources\views/forum/edit.blade.php ENDPATH**/ ?>