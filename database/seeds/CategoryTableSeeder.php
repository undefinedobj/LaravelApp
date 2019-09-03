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
                'title'     => '后端',
                'icon'      => 'fab fa-laravel',
                'uri'       => '',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => '前端',
                'icon'      => 'fab fa-html5',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 3,
                'title'     => '服务器',
                'icon'      => 'fas fa-server',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 0,
                'order'     => 4,
                'title'     => '工具',
                'icon'      => 'fa fa-wrench',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 0,
                'order'     => 5,
                'title'     => '其它',
                'icon'      => 'fas fa-cube',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 0,
                'order'     => 6,
                'title'     => '数据库',
                'icon'      => 'fas fa-database',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 7,
                'title'     => 'PHP',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 8,
                'title'     => 'GoLang',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 9,
                'title'     => 'Laravel',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 10,
                'title'     => 'ThinkPHP',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 11,
                'title'     => 'Yii',
                'uri'       => '/',
            ],
            [
                'parent_id' => 2,
                'order'     => 12,
                'title'     => 'Node.js',
                'uri'       => '/',
            ],
            [
                'parent_id' => 2,
                'order'     => 13,
                'title'     => 'JavaScript',
                'uri'       => '/',
            ],
            [
                'parent_id' => 2,
                'order'     => 14,
                'title'     => 'Vue',
                'uri'       => '/',
            ],
            [
                'parent_id' => 3,
                'order'     => 15,
                'title'     => 'Nginx',
                'uri'       => '/',
            ],
            [
                'parent_id' => 3,
                'order'     => 16,
                'title'     => 'Apache',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 17,
                'title'     => 'MySQL',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 18,
                'title'     => 'SQLServer',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 19,
                'title'     => 'Redis',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 20,
                'title'     => 'Memcache',
                'uri'       => '/',
            ],
            [
                'parent_id' => 5,
                'order'     => 21,
                'title'     => 'PHPStorm',
                'uri'       => '/',
            ],
            [
                'parent_id' => 5,
                'order'     => 22,
                'title'     => 'Git',
                'uri'       => '/',
            ],
            [
                'parent_id' => 6,
                'order'     => 23,
                'title'     => '生活笔记',
                'uri'       => '/',
            ],
        ]);
    }
}
