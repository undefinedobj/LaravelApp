@extends('app')

@section('title', '个人中心'.config('app.name'))

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>Welcome To {{ config('app.name') }}
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" src="{{ Auth::user()->avatar }}" alt="100*100" style="width: 100px">
                        </a>
                    </div>
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item">您的邮箱：{{ Auth::user()->email }}</li>
                        <li class="list-group-item">您的权限：普通用户</li>
                        <li class="list-group-item">上次登录：2019年08月08日</li>
                        <li class="list-group-item">注册时间：{{ Auth::user()->created_at }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-success">
                    <!-- Default panel contents -->
                    <div class="panel-heading">我的评论 <span style="color: red">(4)</span></div>
                    <div class="panel-body">
                        <p>你还没有评论</p>
                    </div>

                    <!-- List group -->
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="#title">评论文章：go语言中的接口</a>
                            <div class="panel-body">
                                接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现 接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现
                            </div>
                            <span class="glyphicon glyphicon-time"></span> 2019-09-01 12:38:19
                        </li>
                        <li class="list-group-item">
                            <a href="#title">评论文章：go语言中的接口</a>
                            <div class="panel-body">
                                接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现 接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现
                            </div>
                            <span class="glyphicon glyphicon-time"></span> 2019-09-01 12:38:19
                        </li>
                        <li class="list-group-item">
                            <a href="#title">评论文章：go语言中的接口</a>
                            <div class="panel-body">
                                接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现 接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现
                            </div>
                            <span class="glyphicon glyphicon-time"></span> 2019-09-01 12:38:19
                        </li>
                        <li class="list-group-item">
                            <a href="#title">评论文章：go语言中的接口</a>
                            <div class="panel-body">
                                接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现 接口是一组方法签名 接口只定义方法，不写方法的实现 结构体是接口的实现
                            </div>
                            <span class="glyphicon glyphicon-time"></span> 2019-09-01 12:38:19
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
@endsection