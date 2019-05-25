@extends('app')

@section('title', env('APP_NAME'))

{{--引入Markdown编辑器代码--}}
@include('editor::head')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2" role="main">

                {!! Form::open(['url' => '/discussions', 'method' => 'post']) !!}

                @include('forum.form')

                <div>
                    {!! Form::submit('发表帖子', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
    </div>
@endsection
