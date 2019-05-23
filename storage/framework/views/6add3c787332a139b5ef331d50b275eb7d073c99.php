<?php $__env->startSection('Register', 'avatar'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php if($errors->any()): ?>
                    <ul class="list-group">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
                <div class="text-center">
                    <img src="<?php echo e(Auth::user()->avatar); ?>" width="50" class="img-circle" alt="">

                    
                    <?php echo Form::open(['route' => 'avatar', 'enctype' => 'multipart/form-data', 'method' => 'post']); ?>

                    <?php echo Form::file('avatar'); ?>

                    <?php echo Form::submit('上传头像', ['class' => 'btn btn-success pull-right']); ?>

                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\laravelapp\resources\views/users/avatar.blade.php ENDPATH**/ ?>