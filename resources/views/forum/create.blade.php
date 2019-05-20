@extends('app')

@section('title', env('APP_NAME'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2" role="main">

                {!! Form::open(['url' => '/discussions', 'method' => 'post']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Body') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                </div>

                <div>
                    {!! Form::submit('发表帖子', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
    </div>
@endsection