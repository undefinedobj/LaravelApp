<br>
<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('preface', 'Preface') !!}
    {!! Form::textarea('preface', null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('category', 'Category') !!}
    {!! Form::select('categories_id', $category, null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    <div class="editor">
        {!! Form::label('body', 'Body') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'myEditor']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('img', 'Image(445 * 190)') !!}
    {!! Form::file('img', ['class' => 'form-control','id'=>'image-upload']) !!}
</div>
{!! Form::image($discussion->img ?? '/images/default-avatar.jpg', null, ['id'=>'image-view', 'width'=>"160", 'height'=>"160"]) !!}

<div class="form-group">
    {!! Form::label('order', 'Order') !!}
    {!! Form::number('order',null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::hidden('hidden-img',$discussion->img ?? null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<script type="text/javascript">
    $(function() {
        $("#image-upload").change(function() {
            var $file = $(this);
            var objUrl = $file[0].files[0];
            //获得一个http格式的url路径:mozilla(firefox)||webkit or chrome
            var windowURL = window.URL || window.webkitURL;
            //createObjectURL创建一个指向该参数对象(图片)的URL
            var dataURL = windowURL.createObjectURL(objUrl);
            $("#image-view").attr("src", dataURL);
        });
    });
</script>
