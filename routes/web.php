<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostsController@index');
// laravel 5 Markdown 编辑器 - 图片上传
Route::post('markdown/upload', 'PostsController@markdownUpload');
Route::get('/user/register', 'UsersController@register');
Route::post('/user/register', 'UsersController@store');
Route::get('user/login', 'UsersController@login')->name('login');
Route::post('user/login', 'UsersController@signIn');
Route::get('user/logout', 'UsersController@logout')->name('logout');
Route::get('user/avatar', 'UsersController@avatar');
Route::post('user/{id}/avatar', 'UsersController@updateAvatar')->name('avatar');

Route::get('/verify/{confirm_code}', 'UsersController@confirmEmail')->name('mail-verify');

Route::resources([
    'discussions'       =>      'PostsController',
    'users'             =>      'UsersController',
    'comments'          =>      'CommentsController',
]);
Route::get('user/person', 'UsersController@person');

/**
 * 纯属瞎玩, 基本没啥用
 *
 * @return string
 */
//Route::any('{namespace}/{class}/{action}', function ($namespace, $class, $action)
//{
//    $class = 'App\\Http\\Controllers\\'.ucfirst(strtolower($namespace)) .'\\'. ucfirst(strtolower($class)) .'Controller';
//
//    if (class_exists($class)) {
//        $classObject = new $class();
//        if (method_exists($classObject, $action)) return call_user_func(array($classObject, $action));
//    }else {
//        return $class. 'not found';
//    }
//});
