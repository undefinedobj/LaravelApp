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
                    <a class="btn btn-primary btn-lg pull-right" href="#" role="button">修改帖子</a>
                    <h4 class="media-heading">{{ $discussion->title }}</h4>
                    {{ $discussion->user->name }}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <div class="col-sm-8 blog-main">

                    <div class="blog-post">

                    </div><!-- /.blog-post -->
                        {!! $html !!}
                    <nav>
                        <ul class="pager">
                            <li><a href="#">Previous</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
@endsection
