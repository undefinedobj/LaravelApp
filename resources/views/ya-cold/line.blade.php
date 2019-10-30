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

<div class="list">
    <div class="header">
        <button type="button" class="layui-btn open">线路添加</button>
        <button type="button" class="layui-btn layui-btn-danger"><a href="{{ url('cold/users') }}">进入用户列表</a></button>
        <button type="button" class="layui-btn Login">登录</button>
        <ul class="layui-nav">
            <li class="layui-nav-item">
                <a>我</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;">退出</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>线路名称</th>
            <th>价格</th>
            <th>操作1</th>
            <th>操作2</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($res as $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->price }}</td>
                <td><button type="button" onclick="del({{ $value->id }})" class="layui-btn delBtn">删除</button></td>
                <td><a href="{{ url('cold/lines/'.$value->id) }}">修改</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="openZhekou" id="openZhekou" style="display: none;">
    <div class="openRow">
        <div class="openCol">
            线路名称:<input type="text" name="" id="lineName"><span id="prompt1"></span>
        </div>
        <div class="openCol">
            线路价格:<input type="text" name="" id="lineMoney"><span id="prompt2"></span>
        </div>
        <button type="button" class="layui-btn layui-btn-fluid submit">确认</button>
    </div>
</div>
<div class="login" id="login" style="display: none;">
    <div class="openRow">
        <div class="openCol">
            <span> 用户名:</span><input type="text" name="" id="">
        </div>
        <div class="openCol">
            <span>密码:</span><input type="text" name="" id="lineMoney">
        </div>
        <button type="button" class="layui-btn layui-btn-fluid loginBtn">登录</button>
    </div>
</div>
<script>
    layui.use(['layer', 'element'], function () {
        var layer = layui.layer;
        var element = layui.element;
    });
    $(document).on('click', '.open', function () {
        layer.open({
            type: 1,
            title: '线路添加',
            shade: 0.3,
            area: ['80%', '80%'],
            content: $('#openZhekou')
        });
    });

    $(document).on('click', '.Login', function () {
        layer.open({
            type: 1,
            title: '登录',
            shade: 0.3,
            area: ['80%', '80%'],
            content: $('#login')
        });
    });

    $('#lineName').blur(function () {
        var lineName = $('#lineName').val();
        if (lineName === '') {
            $('#prompt1').text('不能为空');
            return false;
        } else {
            $('#prompt1').text('OK');
        }
    });
    $('#lineMoney').blur(function () {
        var money = $('#lineMoney').val();
        if (money == '' || isNaN(money)) {
            $('#prompt2').text('必须是数字');
        }
    });
    $('.submit').click(function () {
        var money = $('#lineMoney').val();
        var lineName = $('#lineName').val();

        if (money == '' || isNaN(money)) {
            $('#prompt2').text('必须是数字');
            return false;
        } else if (lineName === '') {
            $('#prompt1').text('不能为空');
            return false;
        } else {
            $('#prompt1').text('OK');
        }
        // ajax_start
        $.ajax({
            type    : "POST",
            url     : "/cold/lines",
            data    : {
                _token : "{{csrf_token()}}",
                name  : lineName,
                price : money,
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
        layer.msg('OK');
        layer.closeAll('page');
    });
    // 删除线路
    function del(id)
    {
        layer.confirm('确认删除么？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            // ajax_start_请求
            $.post("/cold/lines", {
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
    // $(document).on('click', '.delBtn', function () {
    //     var _this = $(this);
    //     layer.confirm('确定要删除吗？', {
    //         btn: ['删除', '取消']
    //     }, function (index, layero) {
    //         _this.parents('tr').remove();
    //         layer.close(index);
    //     }, function (index) {
    //
    //     });
    // });

    $('.loginBtn').click(function () {
        // 如果用户名和密码正确
        if (true) {
            layer.closeAll();
            $('.Login').hide();
            $('.layui-nav').show();
        }
    });
</script>
</body>
</html>
