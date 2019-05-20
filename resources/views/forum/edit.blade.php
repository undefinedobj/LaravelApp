@extends('app')

@section('title', env('APP_NAME'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2" role="main">

                {!! Form::model($discussion, ['url' => '/discussions/'.$discussion->id, 'method' => 'put']) !!}

                @include('forum.form', ['discussion' => $discussion])

                <div>
                    {!! Form::submit('更新帖子', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
@endsection
