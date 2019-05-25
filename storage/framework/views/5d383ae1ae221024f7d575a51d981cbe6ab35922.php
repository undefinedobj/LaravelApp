<div class="form-group">
    <?php echo Form::label('title', 'Title'); ?>

    <?php echo Form::text('title', null, ['class' => 'form-control']); ?>

</div>

<div class="form-group">
    <div class="editor">

        <?php echo Form::textarea('body', null, ['class' => 'form-control','id'=>'myEditor']); ?>

    </div>
</div>
<?php /**PATH D:\laragon\www\laravelapp\resources\views/forum/form.blade.php ENDPATH**/ ?>