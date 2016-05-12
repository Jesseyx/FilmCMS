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

Route::group(['middleware' => 'auth'], function () {
    // 访问权限控制
    Route::group(['middleware' => 'permission'], function () {
        Route::group(['namespace' => 'Home', 'as' => 'home::'], function () {
            Route::get('/', 'HomeController@index');
        });

        // user
        Route::group(['namespace' => 'User', 'as' => 'user::'], function () {
            Route::group(['prefix' => 'user'], function () {
                Route::get('profile', 'UserController@getProfile');
                Route::get('edit', 'UserController@getEdit');
                Route::post('edit', 'UserController@postEdit');
                Route::post('ajax-edit', 'UserController@ajaxEdit');
            });

            Route::resource('user', 'UserController');
        });

        // role
        Route::group(['namespace' => 'Role', 'as' => 'role::'], function () {
            Route::group(['prefix' => 'role'], function () {
                Route::post('ajax-edit', 'RoleController@ajaxEdit');
            });

            Route::resource('role', 'RoleController');
        });

        // password
        Route::group(['namespace' => 'Password'], function () {
            // 参考 image 的解释
            Route::controller('password', 'PasswordController');
        });
    });

    // image
    Route::group(['namespace' => 'Image'], function () {
        // 控制器方法 postUpload 处理 url 为 /image/upload method 为 post 的请求
        Route::controller('image', 'ImageController');
    });
});

Route::group(['namespace' => 'Api', 'as' => 'api::', 'prefix' => 'api'], function () {
    Route::get('user', 'UserController@index');
    Route::get('role', 'RoleController@index');

    Route::group(['prefix' => 'permission'], function () {
       Route::get('all-group', 'PermissionController@getAllGroup');
    });
});
