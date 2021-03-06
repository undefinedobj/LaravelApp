@extends('app')

@section('title', '注册 - '.config('app.name'))

@section('content')

    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
                @if ($errors->any())
                    <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                    </ul>
                @endif

                {!! Form::open(['url' => '/user/register', 'method' => 'post']) !!}
                <div class="form-group">
                    {!! Form::label('name', '用户名') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', '邮箱') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', '密码') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', '确认密码') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('马上注册', ['class' => 'btn btn-success form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
