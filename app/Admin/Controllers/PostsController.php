<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\DiscussionGender;
use App\Models\Discussion;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\User;
use \HyperDown\Parser;
use Encore\Admin\Widgets\Table;

class PostsController extends Controller
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
            ->description('')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content, Parser $parser)
    {
        $discussion = Discussion::findOrFail($id);

        $html = $parser->makeHtml($discussion->body);

        $view = view('laravel-admin.discussions.show', compact('discussion', 'html'))->render();

        return $content
            ->header('Detail')
            ->description('description')
            ->body($view);
//            ->body($this->detail($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Discussion);

        $grid->model()->orderBy('id', 'desc');
        $grid->disableRowSelector();
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
//            $actions->disableView();
//            $actions->append('<a href="/admin/discussions/'.$actions->getKey().'"><i class="fa fa-eye"></i></a>');
        });
        $grid->filter(function ($filter) {
            $filter->like('name', trans('admin.user.name'));
        });
//        自定义工具
//        $grid->tools(function ($tools) {
//            $tools->append(new DiscussionGender());
//        });

        $grid->id('Id');
        $grid->title(trans('admin.title'))->expand(function ($model) {

/************************************** 此处有 BUG ***************************************/

            $comments = $model->comments()->take(10)->get()->map(function ($comment) {
                return $comment->only(['id', /*'user_id',*/ 'body', 'created_at']);
            })->toArray();

//            $user = $model->user()->take(10)->get()->map(function ($comment) {
//                return $comment->only(['id', 'name']);
//            })->toArray();

            return new Table(['ID', trans('admin.discussion.body'), trans('admin.created_at'), trans('admin.user.name')], $comments);
        });
/************************************** 此处有 BUG ***************************************/

        $grid->user_id(trans('admin.username'))->display(function($user_id) {
            return User::find($user_id)->name;
        });
        $grid->last_user_id('Last user id');
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));

        return $grid;
    }

//    /**
//     * Make a show builder.
//     *
//     * @param mixed $id
//     * @return Show
//     */
//    protected function detail($id, Parser $parser)
//    {
//        $show = new Show(Discussion::findOrFail($id));
//
//        $show->id('Id');
//        $show->title('Title');
//        $show->body('Body');
//        $show->user_id('User id');
//        $show->last_user_id('Last user id');
//        $show->created_at(trans('admin.created_at'));
//        $show->updated_at(trans('admin.updated_at'));
//
//        return $show;
//    }
}
