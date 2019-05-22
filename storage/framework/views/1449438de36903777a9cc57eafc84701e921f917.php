<?php $__env->startSection('title', env('APP_NAME')); ?>

<?php $__env->startSection('content'); ?>
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" src="<?php echo e($discussion->user->avatar); ?>" alt="64*64" style="width: 64px">
                    </a>
                </div>
                <div class="media-body">
                    <?php if(Auth::check() && Auth::user()->id == $discussion->user_id): ?>
                        <a class="btn btn-primary btn-lg pull-right" href="<?php echo e(url("discussions/$discussion->id/edit")); ?>" role="button">修改帖子</a>
                    <?php endif; ?>

                    <h4 class="media-heading"><?php echo e($discussion->title); ?></h4>
                    <?php echo e($discussion->user->name); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <div class="blog-post">

                </div><!-- /.blog-post -->
                <?php echo $html; ?>


                <hr>

                
                <?php $__currentLoopData = $discussion->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="<?php echo e($comment->user->avatar); ?>" alt="64*64" style="width: 64px; height: 64px">
                            </a>
                        </div>
                    </div>

                    <div class="media-body">
                            <h4 class="media-heading"><?php echo e($comment->user->name); ?></h4>
                            <?php echo e($comment->body); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <hr>

                
                <?php if(Auth::check()): ?>
                    <?php if($errors->any()): ?>
                        <ul class="list-group">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item list-group-item-danger"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>

                    <?php echo Form::open(['url' => '/comments', 'method' => 'post']); ?>


                    <div class="form-group">
                        <?php echo Form::hidden('discussion_id', $discussion->id, ['class' => 'form-control']); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::textarea('body', null, ['class' => 'form-control']); ?>

                    </div>

                    <div>
                        <?php echo Form::submit('发表评论', ['class' => 'btn btn-primary form-control']); ?>

                    </div>
                    <?php echo Form::close(); ?>

                <?php else: ?>
                    <a href="/user/login" class="btn btn-block btn-success">登录参与评论</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\laravelapp\resources\views/forum/show.blade.php ENDPATH**/ ?>