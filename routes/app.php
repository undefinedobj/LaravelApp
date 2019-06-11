<?php

/*
|--------------------------------------------------------------------------
| APP Routes Demo
|--------------------------------------------------------------------------
|
| App 路由 Demo
|
*/
Route::group(['namespace' => 'Api'], function () {
    Route::resource('user', 'UserController');
});
