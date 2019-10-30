<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="token" name="token" value=" {{ csrf_token() }} ">
    <link rel="stylesheet" href="{{ asset('ya-cold/lib/layui/css/layui.css') }}">
    <script src="{{ asset('ya-cold/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('ya-cold/lib/layui/layui.js') }}"></script>
    <title>{{ '用户列表'.' - '.config('app.name') }}</title>
    <style>
        .list {
            width: 800px;
            margin: 50px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
        }

        .openRow {
            width: 600px;
            margin: 20px auto;
            margin-top: 10vh;
        }

        .openCol {
            width: 600px;
            margin: 20px auto;
            font-size: 22px;
            display: flex;
        }

        .openCol span {
            width: 120px;
            display: block;
        }

        .openCol input {
            margin-right: 10px;
        }

        .layui-nav {
            height: 40px;
            line-height: 40px;
            display: none;
        }

        .layui-nav .layui-nav-item {
            height: 40px;
            line-height: 40px;
        }

        .layui-nav-child {
            top: 40px;
        }
    </style>
</head>

<body>
<form action="{{ url('cold/lines') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="openZhekou" id="openZhekou">
        <div class="openRow">
            <div class="openCol">
                线路名称:<input type="text" name="name" id="lineName" value="{{ $line->name }}"><span id="prompt1"></span>
            </div>
            <div class="openCol">
                线路价格:<input type="text" name="price" id="lineMoney" value="{{ $line->price }}"><span id="prompt2"></span>
            </div>
            <input type="hidden" name="id" id="username" value="{{ $line->id }}"><span id="prompt1"></span>
            <button type="submit" class="layui-btn layui-btn-fluid addUser">确认</button>
        </div>
    </div>
</form>

</body>
</html>
