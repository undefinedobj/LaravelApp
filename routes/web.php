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
//use Illuminate\Routing\Router;

Route::get('/', 'PostsController@index');

Route::get('/user/register', 'UsersController@register');
Route::get('/verify/{confirm_code}', 'UsersController@confirmEmail');
Route::post('/user/register', 'UsersController@store');

Route::resources([
    'discussions' => 'PostsController',
    'users' => 'UsersController',
]);

/*Route::group([
//    'prefix'        => config('admin.route.prefix'),
//     ...
], function (Router $router) {
    $router->get('/', 'PostController@index');
});*/
