<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="token" name="token" value=" {{ csrf_token() }} ">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-style.css') }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/5.10.2/css/all.css">

    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
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
            <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            {{--<li><a href="#service"><i class="glyphicon glyphicon-align-justify"></i> 服务器</a></li>--}}
            @foreach($categories as $category)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="{{ $category->icon }}"></i> {{ $category->title }}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($category->list as $val)
                        <li><a href="/category/{{ $val->id }}"> {{ $val->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li>
                        <a id="" type="button" data-toggle="dropdown" href="###">
                            <img src="{{ Auth::user()->avatar }}" class="img-circle" width="42" height="42" alt="">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="/user/person"> <i class="fa fa-bath"></i> 个人中心</a></li>
                            <li><a href="/user/avatar"> <i class="fa fa-user"></i> 更换头像</a></li>
                            <li><a href="#"> <i class="fa fa-cog"></i> 更换密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('user/logout') }}"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a></li>
                        </ul>

                    </li>
                @else
                    <li class="{{ Request::is('user/register') ? 'active' : '' }}"><a href="{{ url('/user/register') }}">注册</a></li>
                    <li class="{{ Request::is('user/login') ? 'active' : '' }}"><a href="{{ url('/user/login') }}">登录 <span class="sr-only">(current)</span></a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
    @yield('content', 'Default Content')

<hr class="featurette-divider">

<div class="wang-yu" style="background-color: #eae9e9">
    <div class="container">
        <footer class="bt mt-20 pt-20 bg-white">
            <div class="container">
                <div class="text-center footer">
                    <div>王宇的个人博客 <span style="color: black">|京ICP备15048358号-1</span></div>
                    <ul class="bs-docs-footer-links text-muted list-inline">
                        <li>
                            <a style="color: #15b982" target="_blank" href="https://github.com/undefinedobj/">
                                <i class="fab fa-github-square"></i> GitHub 仓库
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
</html>
