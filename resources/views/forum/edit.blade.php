@extends('app')

@section('title', '编辑 - '.$discussion->title.' - '.config('app.name'))

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
            <div class="col-md-offset-2" role="main">

                {!! Form::model($discussion, ['url' => '/discussions/'.$discussion->id, 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}

                @include('forum.form', ['discussion' => $discussion])

                <div>
                    {!! Form::submit('更新帖子', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
@endsection
