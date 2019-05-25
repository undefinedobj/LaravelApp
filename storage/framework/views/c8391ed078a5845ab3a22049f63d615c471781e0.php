
<link rel="stylesheet" href="http://cdn.bootcss.com/codemirror/4.10.0/codemirror.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/8.4/styles/default.min.css">
<script src="http://cdn.bootcss.com/highlight.js/8.4/highlight.min.js"></script>

<script src="http://cdn.bootcss.com/marked/0.3.2/marked.min.js"></script>
<script type="text/javascript" src="http://cdn.bootcss.com/codemirror/4.10.0/codemirror.min.js"></script>
<script type="text/javascript" src="http://cdn.bootcss.com/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>

<link rel="stylesheet" href="<?php echo e(asset('plugin/editor/css/pygment_trac.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugin/editor/css/editor.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('plugin/editor/js/highlight.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('plugin/editor/js/modal.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('plugin/editor/js/MIDI.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('plugin/editor/js/fileupload.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('plugin/editor/js/bacheditor.js')); ?>"></script>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<script type="text/javascript" src="<?php echo e(asset('plugin/editor/js/bootstrap3-typeahead.js')); ?>"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        url = "<?php echo e(url(config('editor.uploadUrl'))); ?>";

        <?php if(config('editor.ajaxTopicSearchUrl',null)): ?>
        ajaxTopicSearchUrl = "<?php echo e(url(config('editor.ajaxTopicSearchUrl'))); ?>";
        <?php else: ?>
        ajaxTopicSearchUrl = null;
        <?php endif; ?>

        var myEditor = new Editor(url,ajaxTopicSearchUrl);
        myEditor.render('#myEditor');
    });
</script>

<style>
    .editor{
        width:<?php echo e(config('editor.width')); ?>;
    }
</style>
<?php /**PATH D:\laragon\www\LaravelApp\resources\views/vendor/editor/head.blade.php ENDPATH**/ ?>