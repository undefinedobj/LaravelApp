<?php $__env->startSection('title', env('APP_NAME')); ?>

<?php $__env->startSection('content'); ?>
    <div class="jumbotron">
        <div class="container">
            <h2>Welcome To <?php echo e(env('APP_NAME')); ?>

                <a class="btn btn-primary btn-lg pull-right" href="<?php echo e(url('discussions/create')); ?>" role="button">发布新的帖子 »</a>
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
            <?php $__currentLoopData = $discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" src="<?php echo e($discussion->user->avatar); ?>" alt="64*64" style="width: 64px">
                        </a>
                    </div>
                    <div class="media-body">
                        
                        <h4 class="media-heading">
                            <a href="/discussions/<?php echo e($discussion->id); ?>"><?php echo e($discussion->title); ?></a>

                            <div class="media-conversation-meta">
                                <span class="media-conversation-replies">
                                    <a href="#"><?php echo e(count($discussion->comments)); ?></a>
                                    回复
                                </span>
                            </div>
                        </h4>
                        <?php echo e($discussion->user->name); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($discussions->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\laravelapp\resources\views/forum/index.blade.php ENDPATH**/ ?>