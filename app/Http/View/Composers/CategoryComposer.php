<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class CategoryComposer
{
    protected $categories;

    public function __construct(Category $categories)
    {
        // Dependencies automatically resolved by service container...
        $this->categories = $categories;
    }

    /**
     * 菜单栏的视图合成器，并进行 cache 处理，过期时间为：当前时间 + 1天
     *
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Cache::has('categories_all')){

            $cache = Cache::get('categories_all');

        }else{
            $cache = $this->categories->tree();

            Cache::put('categories_all', $cache, now()->addDay());
        }

        $view->with('categories', $cache);
    }
}
