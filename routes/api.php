<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});

//$middleWare = ['middleware' => []];
$groupConfig = ['middleware' => ['auth:api']];


Route::group( $groupConfig, function(){

    Route::resource('articles', 'Api\ArticleController');
    Route::resource('article-types', 'Api\ArticleTypeController');
    Route::post('upload_image', 'Api\ImageController@upload')->name('upload_image');
});



