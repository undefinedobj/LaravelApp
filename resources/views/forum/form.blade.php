<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('preface', 'Preface') !!}
    {!! Form::textarea('preface', null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    <div class="editor">
        {!! Form::label('body', 'Body') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'myEditor']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('img', 'Image') !!}
    {!! Form::file('img', ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('sort', 'Sort') !!}
    {!! Form::number('sort',null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::hidden('hidden-img',$discussion->img ?? null, ['class' => 'form-control','id'=>'form-control']) !!}
</div>
