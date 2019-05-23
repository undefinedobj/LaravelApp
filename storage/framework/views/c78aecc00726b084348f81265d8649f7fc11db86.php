<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link href="<?php echo e(asset('vendor/font-awesome-4.7.0/css/font-awesome.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app-style.css')); ?>">
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?php echo e(env('APP_NAME')); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(Auth::check()): ?>
                    <li>
                        <a id="" type="button" data-toggle="dropdown" href="###"><img src="<?php echo e(Auth::user()->avatar); ?>" class="img-circle" width="42" alt=""></a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="#"> <i class="fa fa-bath"></i> <?php echo e(Auth::user()->name); ?></a></li>
                            <li><a href="#"> <i class="fa fa-user"></i> 更换头像</a></li>
                            <li><a href="#"> <i class="fa fa-cog"></i> 更换密码</a></li>
                            <li><a href="#"> <i class="fa fa-heart"></i> 特别感谢</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo e(url('user/logout')); ?>"><i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>

                    </li>


                <?php else: ?>
                    <li class="<?php echo e(Request::is('user/register') ? 'active' : ''); ?>"><a href="<?php echo e(url('/user/register')); ?>">Register</a></li>
                    <li class="<?php echo e(Request::is('user/login') ? 'active' : ''); ?>"><a href="<?php echo e(url('/user/login')); ?>">Login In <span class="sr-only">(current)</span></a></li>
                    
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
    <?php echo $__env->yieldContent('content', 'Default Content'); ?>

<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>
<?php /**PATH D:\laragon\www\laravelapp\resources\views/app.blade.php ENDPATH**/ ?>