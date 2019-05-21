<?php $__env->startSection('Register', 'Laravel App'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
                <?php if($errors->any()): ?>
                    <ul class="list-group">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
                <?php if(Session::has('user_login_failed')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo e(Session::get('user_login_failed')); ?>

                    </div>
                <?php endif; ?>
                <?php echo Form::open(['url' => '/user/login', 'method' => 'post']); ?>

                <div class="form-group">
                    <?php echo Form::label('email', '邮箱'); ?>

                    <?php echo Form::email('email', old('email'), ['class' => 'form-control']); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('password', '密码'); ?>

                    <?php echo Form::password('password', ['class' => 'form-control']); ?>

                </div>

                <?php echo Form::submit('马上登录', ['class' => 'btn btn-success form-control']); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\laravelapp\resources\views/users/login.blade.php ENDPATH**/ ?>