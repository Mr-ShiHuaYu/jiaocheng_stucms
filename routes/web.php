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
// 登录
Route::get('/login', 'Login@index')->name('login');
Route::post('/dologin', 'Login@store')->name('dologin');

// 首页
Route::get('/','Index@index')->name('index');
// 欢迎页
Route::get('/welcome','Index@welcome')->name('welcome');

Route::get('/test','Test@index')->name('test');
