<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Support\Facades\Cache;

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
        /*if (Cache::has('discussions_all')){

            $cache = Cache::get('discussions_all');
        }else{*/

            $columns = ['id','user_id','categories_id','title','preface','created_at'];

            $cache = Discussion::with([
                'category' => function ($query) {
                    $query->select('id','title');
                },
                'user' => function ($query) {
                    $query->select('id','name');
                }
            ])->where('categories_id', $id)->paginate(config('app.perPage'),$columns);

        /*    Cache::put('discussions_all', $cache, now()->addDay());
        }*/

        return  view('forum.category', ['discussions' => $cache]);
    }
}
