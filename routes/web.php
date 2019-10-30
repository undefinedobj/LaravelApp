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
Route::get('user/register', 'UsersController@register');
Route::post('user/register', 'UsersController@store');
Route::get('user/login', 'UsersController@login')->name('login');
Route::post('user/login', 'UsersController@signIn');
Route::get('user/logout', 'UsersController@logout')->name('logout');
Route::get('user/avatar', 'UsersController@avatar');
Route::post('user/{id}/avatar', 'UsersController@updateAvatar')->name('avatar');
Route::get('verify/{confirm_code}', 'UsersController@confirmEmail')->name('mail-verify');// 功能废弃
Route::get('user/person', 'UsersController@person');
Route::get('category/{id}', 'CategoriesController@index');

Route::post('comments', 'CommentsController@store');    // 评论
Route::resources([
    'discussions'       =>      'PostsController',
    'users'             =>      'UsersController',
    // 'comments'          =>      'CommentsController',
]);
Route::get('search', 'PostsController@search');
/**
 * 微博社交扩展
 */
Route::get( '/auth/{social}', 'Auth\AuthenticationController@getSocialRedirect' )
    ->middleware('guest');
Route::get( '/auth/{social}/callback', 'Auth\AuthenticationController@getSocialCallback' )
    ->middleware('guest');


/**
 * 亚冷
 */
Route::group([
    'prefix'        => 'cold',
    'namespace'     => 'YaCold',
], function () {
    Route::get('users', 'UserController@index')->name('cold.users');
    Route::get('users/{id}', 'UserController@edit');
    Route::put('users', 'UserController@update');
    Route::post('users', 'UserController@store');
    Route::delete('users', 'UserController@destroy');

    Route::get('lines', 'LineController@index')->name('cold.lines');;
    Route::get('lines/{id}', 'LineController@edit');
    Route::put('lines', 'LineController@update');
    Route::post('lines', 'LineController@store');
    Route::delete('lines', 'LineController@destroy');
});


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
