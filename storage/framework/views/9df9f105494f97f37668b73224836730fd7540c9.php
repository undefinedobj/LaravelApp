<?php $__env->startSection('title', env('APP_NAME')); ?>

<?php $__env->startSection('content'); ?>


<?php echo $__env->make('editor::head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-offset-2" role="main">

                <?php echo Form::open(['url' => '/discussions', 'method' => 'post']); ?>


                <?php echo $__env->make('forum.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div>
                    <?php echo Form::submit('发表帖子', ['class' => 'btn btn-primary form-control']); ?>

                </div>
                <?php echo Form::close(); ?>

            </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LaravelApp\resources\views/forum/create.blade.php ENDPATH**/ ?>