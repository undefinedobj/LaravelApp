@extends('app')

@section('title', env('APP_NAME'))

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>Welcome To {{ env('APP_NAME') }}
                <a class="btn btn-primary btn-lg pull-right" href="{{ url('discussions/create') }}" role="button">发布新的帖子 »</a>
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
            @foreach($discussions as $discussion)
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" src="{{ $discussion->user->avatar }}" alt="64*64" style="width: 64px">
                        </a>
                    </div>
                    <div class="media-body">
                        {{--<h4 class="media-heading">{{ $discussion->title }}</h4>--}}
                        <h4 class="media-heading"><a href="/discussions/{{ $discussion->id }}">{{ $discussion->title }}</a></h4>
                        {{ $discussion->user->name }}
                    </div>
                </div>
            @endforeach
                {{ $discussions->links() }}
            </div>
        </div>
    </div>
@endsection