<?php

namespace App\Http\Controllers;

use App\Models\Discussion;

class CategoriesController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $discussions = Discussion::with([
            'category' => function ($query) {
                $query->select('id','title');
            }
        ])->where('categories_id', $id)->limit(10)->paginate();

        return  view('forum.category', compact('discussions'));
    }
}
