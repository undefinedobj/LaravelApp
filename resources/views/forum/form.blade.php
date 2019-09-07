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
    {!! Form::file('img', ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('order', 'Sort') !!}
    {!! Form::number('order',null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::hidden('hidden-img',$discussion->img ?? null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>
