<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* just use web group by default, 已经默认被 web 中间件处理了，如果再引入一次的话，验证不生效，不知道什么原因 */

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'as' => 'admin::'], function () {
//    Route::group(['middleware' => ['access']], function () {
        Route::get('/index', 'HomeController@index');
//    });

    Route::group(['prefix' => 'movie'], function () {
        // 影视库
        Route::resource('library', 'MovieLibraryController');
    });
});