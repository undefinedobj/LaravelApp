<?php

/*
|--------------------------------------------------------------------------
| APP Routes Demo
|--------------------------------------------------------------------------
|
| App 路由 Demo
|
*/
Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::resources([
        'user' => 'UserController',
    ]);
});
