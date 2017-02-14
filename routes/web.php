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
 
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'IndexController@index');

Route::get('/index/test', 'IndexController@test');

Route::get('/article/create', 'ArticleController@create');
Route::get('/article/firstOrCreate', 'ArticleController@firstOrCreate');
Route::get('/article/firstOrNew', 'ArticleController@firstOrNew');
Route::get('/article/updateOrCreate', 'ArticleController@updateOrCreate');
Route::get('/article/delete', 'ArticleController@delete');
Route::get('/article/destroy', 'ArticleController@destroy');
Route::get('/article/index', 'ArticleController@index');

// Route::get('/test', 'IndexController@test');
// Route::get('/test/', 'IndexController@test');
