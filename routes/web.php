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
// スタートページにアクセスが来たら、welcome.phpファイルを表示する
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// function以下全てのRoutingの設定に適用、adminから始まるURLに対し、ログイン認証をする
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     
     // admin/profile/createにアクセスが来たら、Adminディレクトリ配下のProfileController内のaddアクションを呼び出す
     // Route::get('admin/news/create', 'Admin\NewsController@add');この書き方でもOK
     Route::get('profile/create', 'Admin\ProfileController@add');
     Route::get('profile/edit', 'Admin\ProfileController@edit');
     Route::get('news/create', 'Admin\NewsController@add');
     Route::get('news', 'Admin\NewsController@index');
     Route::get('news/edit','Admin\NewsController@edit');
     Route::get('news/delete','Admin\NewsController@delete');
     Route::get('profile/delete','Admin\ProfileController@delete');
     Route::get('profile', 'Admin\ProfileController@index');
     Route::post('news/edit','Admin\NewsController@update');
     Route::post('news/create', 'Admin\NewsController@create');
     Route::post('profile/create', 'Admin\ProfileController@create');
     Route::post('profile/edit', 'Admin\ProfileController@update');
});

Route::get('/about', 'HomeController@about');

Route::get('/', 'NewsController@index');

Route::get('/profile', 'ProfileController@index');