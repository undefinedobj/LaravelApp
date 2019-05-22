@extends('app')

@section('title', env('APP_NAME'))

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" src="{{ $discussion->user->avatar }}" alt="64*64" style="width: 64px">
                    </a>
                </div>
                <div class="media-body">
                    @if (Auth::check() && Auth::user()->id == $discussion->user_id)
                        <a class="btn btn-primary btn-lg pull-right" href="{{ url("discussions/$discussion->id/edit") }}" role="button">修改帖子</a>
                    @endif

                    <h4 class="media-heading">{{ $discussion->title }}</h4>
                    {{ $discussion->user->name }}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <div class="blog-post">

                </div><!-- /.blog-post -->
                {!! $html !!}

                <hr>

                {{-- 评论 --}}
                @foreach ($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="{{ $comment->user->avatar }}" alt="64*64" style="width: 64px; height: 64px">
                            </a>
                        </div>
                    </div>

                    <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</h4>
                            {{ $comment->body }}
                    </div>
                @endforeach

                <hr>

                {{-- 评论输框 --}}
                @if (Auth::check())
                    @if ($errors->any())
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/comments', 'method' => 'post']) !!}

                        <div class="form-group">
                            {!! Form::hidden('discussion_id', $discussion->id, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                        </div>

                        <div>
                            {!! Form::submit('发表评论', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                    {!! Form::close() !!}
                @else
                    <a href="/user/login" class="btn btn-block btn-success">登录参与评论</a>
                @endif

            </div>
        </div>
    </div>
@endsection
