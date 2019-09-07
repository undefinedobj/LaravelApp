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
                    <div id="validation-errors"></div>
                    <img src="{{ Auth::user()->avatar }}" width="120" height="120" class="img-circle" id="user-avatar" alt="">

                    @php
                        $id = Auth::user()->id
                    @endphp

                    {{-- 头像上传.form --}}
                    {!! Form::open(['url' => "user/$id/avatar", 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}
                    {!! Form::label('avatar', 'Avatar (120 * 120)') !!}
                    {!! Form::file('avatar') !!}
                    {!! Form::submit('上传头像', ['class' => 'btn btn-success pull-right']) !!}
                    {!! Form::close() !!}

                    {{-- 使用Ajax上传用户头像.form --}}
{{--                    {!! Form::open(['url'=>'/user/$id/avatar','files'=>true,'id'=>'avatar']) !!}--}}
{{--                    <div class="text-center">--}}
{{--                        <button type="button" class="btn btn-success avatar-button" id="upload-avatar">上传新的头像</button>--}}
{{--                    </div>--}}
{{--                    {!! Form::file('avatar',['class'=>'avatar','id'=>'image']) !!}--}}
{{--                    {!! Form::close() !!}--}}

                    <div class="span5">
                        <div id="output" style="display:none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- 使用Ajax上传用户头像 --}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            var options = {--}}
{{--                beforeSubmit:  showRequest,--}}
{{--                success:       showResponse,--}}
{{--                dataType: 'json'--}}
{{--            };--}}
{{--            $('#image').on('change', function(){--}}
{{--                $('#upload-avatar').html('正在上传...');--}}
{{--                $('#avatar').ajaxForm(options).submit();--}}
{{--            });--}}
{{--        });--}}
{{--        function showRequest() {--}}
{{--            $("#validation-errors").hide().empty();--}}
{{--            $("#output").css('display','none');--}}
{{--            return true;--}}
{{--        }--}}

{{--        function showResponse(response)  {--}}
{{--            if(response.success == false)--}}
{{--            {--}}
{{--                var responseErrors = response.errors;--}}
{{--                $.each(responseErrors, function(index, value)--}}
{{--                {--}}
{{--                    if (value.length != 0)--}}
{{--                    {--}}
{{--                        $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');--}}
{{--                    }--}}
{{--                });--}}
{{--                $("#validation-errors").show();--}}
{{--            } else {--}}
{{--                $('#user-avatar').attr('src',response.avatar);--}}
{{--                $('#upload-avatar').html('更换新的头像');--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
@endsection
