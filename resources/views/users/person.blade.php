@extends('app')

@section('title', Auth::user()->name.' - '.config('app.name'))

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
                    <div class="panel-heading">我的评论 <span style="color: red">({{ $comments->total() }})</span></div>
                    @if ($comments->isEmpty())
                        <div class="panel-body">
                            <p>你还没有评论</p>
                        </div>
                    @else
                        <!-- List group -->
                        <ul class="list-group">
                        @foreach($comments as $comment)
                            <li class="list-group-item">
                                <a href="/discussions/{{ $comment->discussion->id }}">评论文章：{{ $comment->discussion->title }}</a>
                                <div class="panel-body">
                                    {{ $comment->body }}
                                </div>
                                <span class="glyphicon glyphicon-time"></span> {{ $comment->created_at }}
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </div>
                {{ $comments->links() }}
            </div>

        </div>

    </div>
@endsection
