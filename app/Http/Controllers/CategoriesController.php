<?php

namespace App\Http\Controllers;

use App\Models\Discussion;

class CategoriesController extends Controller
{
    /**
     * 获取当前分类下的帖子
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $discussions = Discussion::with([
            'category' => function ($query) {
                $query->select('id','title');
            }
        ])->where('categories_id', $id)->limit(10)->paginate(config('app.perPage'));

        return  view('forum.category', compact('discussions'));
    }
}
