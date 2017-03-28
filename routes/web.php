<?php


Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('index', 'IndexController@index');

#region UserCenter

    Route::get('/home', 'UserCenter\UserCenterController@index');

#endregion

#region 文章管理

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/user/article/list', 'UserCenter\ArticleController@list')->name('user-article-list');
        Route::get('/user/article/create', 'UserCenter\ArticleController@create')->name('article-create');
        Route::post('/user/article/create', 'UserCenter\ArticleController@create')->name('article-create');
        Route::get('/user/article/edit', 'UserCenter\ArticleController@edit')->name('article-edit');
        Route::get('/user/article/del', 'UserCenter\ArticleController@del')->name('article-del');
    });

#endregion
