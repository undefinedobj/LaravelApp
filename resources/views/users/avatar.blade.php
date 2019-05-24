@extends('app')

@section('Register', 'avatar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if ($errors->any())
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="text-center">
                    <img src="{{ Auth::user()->avatar }}" width="50" class="img-circle" alt="">

                    @php
                        $id = Auth::user()->id
                    @endphp

                    {{-- 头像上传.form --}}
                    {!! Form::open(['url' => "user/$id/avatar", 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}
                    {!! Form::file('avatar') !!}
                    {!! Form::submit('上传头像', ['class' => 'btn btn-success pull-right']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
