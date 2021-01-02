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
        Route::get('/', 'Index@index')->name('index');
        // 欢迎页
        Route::get('/welcome', 'Index@welcome')->name('welcome');
        // 退出
        Route::get('/logout','Login@logout')->name('logout');

        // 用户
        Route::resource('user','User');
        Route::get('/getuser','User@getUser')->name('getuser');
    }
);

// 不需要登录的
Route::middleware('guest')->group(
    function () {
        // 登录
        Route::get('/login', 'Login@index')->name('login');
        Route::post('/dologin', 'Login@store')->name('dologin');
    }
);


Route::get('/test', 'Test@index')->name('test');
