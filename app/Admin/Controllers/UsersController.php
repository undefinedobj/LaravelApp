<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class UsersController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description()
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description()
            ->body($this->detail($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->disableRowSelector();
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->filter(function ($filter) {
            $filter->like('name', trans('admin.user.name'));
            $filter->like('email', trans('admin.user.email'));
            $filter->equal('is_confirmed', trans('admin.verification.is_confirmed'))->radio([
                '' => 'All',
                0  => '未验证',
                1  => '已验证'
            ]);
        });

        $grid->id('Id');
        $grid->name(trans('admin.user.name'))->modal('评论', function ($model) {

            $comments = $model->comments()->take(10)->get()->map(function ($comment) {
                return $comment->only(['id', 'discussion_id', 'body', 'created_at']);
            });

            return new Table(['ID', '评论 ID', '内容', '发布时间'], $comments->toArray());
        });
        $grid->avatar(trans('admin.user.avatar'))->image(config('app.url'), 50, 50);
        $grid->email(trans('admin.user.email'));
        $grid->is_confirmed(trans('admin.verification.is_confirmed'))->using(['未验证', '已验证'])->badge();
        $grid->email_verified_at(trans('admin.verification.email_verified_at'));
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name(trans('admin.user.name'));
        $show->avatar(trans('admin.user.avatar'))->image();
        $show->email(trans('admin.user.email'));
        $show->is_confirmed(trans('admin.verification.is_confirmed'))->using(['No', 'Yes'])->badge();
        $show->email_verified_at(trans('admin.email_verified_at'));
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }
}
