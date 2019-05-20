<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                {{--<li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="###">{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ url('user/logout') }}"> Logout </a></li>
                @else
                    <li class="{{ Request::is('user/register') ? 'active' : '' }}"><a href="{{ url('/user/register') }}">Register</a></li>
                    <li class="{{ Request::is('user/login') ? 'active' : '' }}"><a href="{{ url('/user/login') }}">Login In <span class="sr-only">(current)</span></a></li>
                    {{--<li><a href="../navbar-fixed-top/">Fixed top</a></li>--}}
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
    @yield('content', 'Default Content')
</body>
</html>
