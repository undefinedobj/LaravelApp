<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">详细</h3>

        <div class="box-tools">
            </div><div class="btn-group pull-right">
                <a href="/admin/discussions" class="btn btn-sm btn-default" title="列表">
                    <i class="fa fa-list"></i><span class="hidden-xs"> 列表</span>
                </a>
            </div>
        </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">

            <div class="fields-group">

                <div class="form-group ">
                    <label class="col-sm-2 control-label">Id</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin box-show">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{ $discussion->id }}&nbsp;
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 control-label">{{ trans('admin.title') }}</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin box-show">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{ $discussion->title }}&nbsp;
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 control-label">User id</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin box-show">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{ $discussion->user_id }}&nbsp;
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 control-label">Last user id</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin box-show">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{ $discussion->last_user_id }}&nbsp;
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 control-label">创建时间</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin box-show">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{ $discussion->created_at }}&nbsp;
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 control-label">更新时间</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin box-show">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{ $discussion->updated_at }}&nbsp;
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 control-label">{{ trans('admin.discussion.body') }}</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin box-show">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {!! $html !!}&nbsp;
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
    </div>
</div>
