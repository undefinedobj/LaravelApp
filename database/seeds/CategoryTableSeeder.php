<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => '前端',
                'icon'      => 'fab fa-html5',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => '后端',
                'icon'      => 'fab fa-laravel',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => '服务器',
                'icon'      => 'fas fa-server',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => '工具',
                'icon'      => 'fa fa-wrench',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => '其它',
                'icon'      => 'fas fa-cube',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => '数据库',
                'icon'      => 'fas fa-database',
                'uri'       => 'auth/menu',
            ]
        ]);
    }
}
