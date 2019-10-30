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

<div class="list">
    <button type="button" class="layui-btn open">用户名添加</button>
    <button type="button" class="layui-btn layui-btn-danger"><a href="{{ url('cold/lines') }}">进入线路列表</a></button>
    <table class="layui-table userList">
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
            <th>折扣比例</th>
            <th>操作1</th>
            <th>操作2</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ $user->created_at }}</td>
                <td><a class="zhekou">{{ $user->discount->discount ?? 0 }}</a></td>
                <td><button type="button" onclick="del({{ $user->id }})" class="layui-btn delBtn">删除</button></td>
                <td><a href="{{ url('cold/users/'.$user->id) }}">修改</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
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
        {{--<div class="openCol">
            线路名称:<input type="text" name="" id="">
            <button type="button" class="layui-btn searchBtn">搜索</button>
        </div>--}}
        <div class="openCol" id="searchLine">
            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>线路名称</th>
                    <th>线路价格</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($lines as $line)
                    <tr>
                        <td>{{ $line->name }}</td>
                        <td>{{ $line->price }}</td>
                        <td><button type="button" class="layui-btn addBtn">添加</button></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        {{--<div class="openCol" id="myLine">
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
        </div>--}}
    </div>
</div>

<script>
    layui.use(['layer', 'form'], function () {
        var layer = layui.layer;
        var form = layui.form;
    });
    // 用户名添加弹框
    $(document).on('click', '.open', function () {
        layer.open({
            type: 1,
            title: '用户名添加',
            shade: 0.3,
            area: ['80%', '80%'],
            content: $('#openDiv')
        });
    });
    // 折扣线路弹框
    $(document).on('click', '.zhekou', function () {
        layer.open({
            type: 1,
            title: '折扣线路添加',
            area: ['80%', '80%'],
            content: $('#openZhekou')
        });
    });
    // 添加线路
    $(document).on('click', '.addBtn', function () {
        var _this = $(this);
        layer.confirm('确定要添加吗？', {
            btn: ['确定', '取消']
        }, function (index, layero) {
            var str = _this.parents('tr');
            $('#myLine tbody').append(str);
            $('#myLine button').each(function () {
                $(this).text('删除');
                $(this).removeClass('addBtn').addClass('myLineDel')
            });
            layer.close(index);
        }, function (index) {

        });
    });
    // 弹框里面的删除
    $(document).on('click', '.myLineDel', function () {
        var _this = $(this);
        layer.confirm('确定要删除吗？', {
            btn: ['删除', '取消']
        }, function (index, layero) {
            var str = _this.parents('tr');
            $('#searchLine tbody').append(str);
            $('#searchLine button').each(function () {
                $(this).text('删除');
                $(this).removeClass('myLineDel').addClass('addBtn');
            });
            layer.close(index);
        }, function (index) {

        });
    });
    // 删除
    function del(id)
    {
        layer.confirm('确认删除么？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            // ajax_start_请求
            $.post("/cold/users", {
                id          : id,
                _token      : "{{csrf_token()}}",
                _method     : 'DELETE'
            }, function(data){

                if (data ==1) {
                    layer.msg('删除成功');
                    window.location.reload();

                }
            });// ajax_end_请求
        });
    }
    /*$(document).on('click', '.delBtn',function () {
        var _this = $(this);

        layer.confirm('确定要删除吗？', {
            btn: ['删除', '取消']
        }, function (index, layero) {

            _this.parents('tr').remove();
            layer.close(index);
        }, function (index) {

        });
    });*/
    // 用户名密码判断
    $('#userVal').blur(function () {
        if ($(this).val() !== '') {
            $('#prompt1').text('OK');
        } else {
            $('#prompt1').text('用户名不能为空');
            return false;
        }
    });
    $('#psw2').blur(function () {
        var psw1 = $('#psw1').val();
        var psw2 = $('#psw2').val();
        if (psw1 == '' || psw2 == '') {
            $('#prompt2').text('密码不能为空');
            return false;
        } else if (psw1 !== psw2) {
            $('#prompt2').text('密码输入需一致');
            return false;
        } else {
            $('#prompt2').text('');
        }
    });
    // 提交
    $('.addUser').click(function () {
        var username = $('#username').val();
        var psw1 = $('#psw1').val();
        var psw2 = $('#psw2').val();
        var psw_len = psw1.length;
        var username_len = username.length;
        if ($('#userVal').val() == '') {
            $('#prompt1').text('用户名不能为空');
            return false;
        }else if (username_len < 4) {
            $('#prompt2').text('用户名长度不能少于4个字符');
            return false;
        } else if (psw_len < 6) {
            $('#prompt2').text('密码长度不能少于6个字符');
            return false;
        } else if (psw1 == '' || psw2 == '') {
            $('#prompt2').text('密码不能为空');
            return false;
        } else if (psw1 !== psw2) {
            $('#prompt2').text('密码输入需一2致');
            return false;
        } else {
            $('#prompt2').text('');
        }
        // ajax_start
        $.ajax({
            type    : "POST",
            url     : "/cold/users",
            data    : {
                _token : "{{csrf_token()}}",
                username : username,
                password : psw1,
                password_confirmation : psw2,
            },
            success: function (Data) {
                layer.msg('添加成功');
                location.reload();
            },
            error: function () {
                alert("添加失败");
                return false;
            }
        });
        //ajax_end
        // layer.msg('OK');
        layer.closeAll('page');
    });
</script>
</body>
</html>
