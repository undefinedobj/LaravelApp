@extends('app')

@section('title', '发布文章 - '.config('app.name'))

@section('content')

{{--引入Markdown编辑器代码--}}
@include('editor::head')

    <div class="jumbotron">
        <div class="container">
            <h2>Welcome To {{ config('app.name') }}
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>

            <div class="col-md-10" role="main">
                @if ($errors->any())
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::open(['url' => '/discussions', 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}

                @include('forum.form')

                <div>
                    {!! Form::submit('发布文章', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>

            <div class="col-md-1"></div>
        </div>
    </div>
@endsection
