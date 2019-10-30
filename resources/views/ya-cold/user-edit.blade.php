<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

{{--<div class="list">--}}
{{--    <button type="button" class="layui-btn open2">添加用户名</button>--}}
{{--    <table class="layui-table userList">--}}
{{--        <colgroup>--}}
{{--            <col width="150">--}}
{{--            <col width="200">--}}
{{--            <col>--}}
{{--        </colgroup>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>用户名</th>--}}
{{--            <th>密码</th>--}}
{{--            <th>注册时间</th>--}}
{{--            <th>折扣线路</th>--}}
{{--            <th>操作1</th>--}}
{{--            <th>操作2</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach ($users as $user)--}}
{{--            <tr>--}}
{{--                <td>{{ $user->username }}</td>--}}
{{--                <td>{{ $user->password }}</td>--}}
{{--                <td>{{ $user->created_at }}</td>--}}
{{--                <td><a class="zhekou">31122</a></td>--}}
{{--                <td><button type="button" onclick="del({{ $user->id }})" class="layui-btn delBtn">删除</button></td>--}}
{{--                <td><a href="{{ url('cold/users/'.$user->id) }}">修改</a></td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--</div>--}}

    <form action="{{ url('cold/users') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="openDiv2" id="openDiv2">
            <div class="openRow">
                <div class="openCol">
                    <span> 用户名:</span>
                    <input type="text" name="username" id="username" value="{{ $user->username }}"><span id="prompt1"></span>
                    <input type="hidden" name="id" id="username" value="{{ $user->id }}"><span id="prompt1"></span>
                </div>
                <button type="submit" class="layui-btn layui-btn-fluid addUser">确认</button>
            </div>
        </div>
    </form>

    {{-- 无用code --}}
    <div class="openDiv" style="display: none;" id="openDiv">
        <div class="openRow">
            <div class="openCol">
                <span> 用户名:</span>
                <input type="text" name="" id="username"><span id="prompt1"></span>
            </div>
            <div class="openCol">
                <span>密码:</span>
                <input type="password" name="" id="psw1">
            </div>
            <div class="openCol">
                <span>重复密码:</span>
                <input type="password" name="" id="psw2"><span id="prompt2"></span>
            </div>
            <button type="button" class="layui-btn layui-btn-fluid addUser">确认</button>
        </div>
    </div>
    <div class="openZhekou" id="openZhekou" style="display: none;">
        <div class="openRow">
            <div class="openCol">
                线路名称:<input type="text" name="" id="">
                <button type="button" class="layui-btn searchBtn">搜索</button>
            </div>
            <div class="openCol" id="searchLine">
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>用户名</th>
                        <th>密码</th>
                        <th>注册时间</th>
                        <th>折扣线路</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>贤心</td>
                        <td>密码</td>
                        <td>2018-11-29</td>
                        <td><a class="zhekou">31</a></td>
                        <td><button type="button" class="layui-btn addBtn">添加</button></td>
                    </tr>
                    <tr>
                        <td>许闲心</td>
                        <td>密码</td>
                        <td>2018-11-28</td>
                        <td><a class="zhekou">24</a></td>
                        <td><button type="button" class="layui-btn addBtn">添加</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="openCol" id="myLine">
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>用户名</th>
                        <th>密码</th>
                        <th>注册时间</th>
                        <th>折扣线路</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>贤心</td>
                        <td>密码</td>
                        <td>2018-11-29</td>
                        <td><a class="zhekou">3</a></td>
                        <td><button type="button" class="layui-btn myLineDel">删除</button></td>
                    </tr>
                    <tr>
                        <td>许闲心</td>
                        <td>密码</td>
                        <td>2018-11-28</td>
                        <td><a class="zhekou">4</a></td>
                        <td><button type="button" class="layui-btn myLineDel">删除</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
