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

// 需要登录的
Route::middleware('auth')->group(
    function () {
        // 首页
        Route::get('/', 'IndexController@index')->name('index');
        // 欢迎页
        Route::get('/welcome', 'IndexController@welcome')->name('welcome');
        // 退出
        Route::get('/logout','LoginController@logout')->name('logout');

        // 用户
        Route::resource('user','UserController');
        Route::get('/getuser','UserController@getUser')->name('getuser');
    }
);

// 不需要登录的
Route::middleware('guest')->group(
    function () {
        // 登录
        Route::get('/login', 'LoginController@index')->name('login');
        Route::post('/dologin', 'LoginController@store')->name('dologin');
    }
);


Route::any('/test', 'TestController@index')->name('test');
