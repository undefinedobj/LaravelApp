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
//        Category::truncate();

        Category::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => '后端',
                'icon'      => 'fab fa-laravel',
                'uri'       => '/',
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
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 4,
                'title'     => '工具',
                'icon'      => 'fa fa-wrench',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 5,
                'title'     => '其它',
                'icon'      => 'fas fa-cube',
                'uri'       => '/',
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
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 8,
                'title'     => 'GoLang',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 9,
                'title'     => 'Laravel',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 10,
                'title'     => 'ThinkPHP',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 1,
                'order'     => 11,
                'title'     => 'Yii',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 2,
                'order'     => 12,
                'title'     => 'Node.js',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 2,
                'order'     => 13,
                'title'     => 'JavaScript',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 2,
                'order'     => 14,
                'title'     => 'Vue',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 3,
                'order'     => 15,
                'title'     => 'Nginx',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 3,
                'order'     => 16,
                'title'     => 'Apache',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 17,
                'title'     => 'MySQL',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 18,
                'title'     => 'SQLServer',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 19,
                'title'     => 'Redis',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 4,
                'order'     => 20,
                'title'     => 'Memcache',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 5,
                'order'     => 21,
                'title'     => 'PHPStorm',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 5,
                'order'     => 22,
                'title'     => 'Git',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
            [
                'parent_id' => 6,
                'order'     => 23,
                'title'     => '生活笔记',
                'icon'      => 'glyphicon glyphicon-align-justify',
                'uri'       => '/',
            ],
        ]);
    }
}
