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

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index')->name('index');

Route::get('/index/test', 'IndexController@test')->middleware('age');

Route::get('/article/create', 'ArticleController@create');
Route::get('/article/firstOrCreate', 'ArticleController@firstOrCreate');
Route::get('/article/firstOrNew', 'ArticleController@firstOrNew');
Route::get('/article/updateOrCreate', 'ArticleController@updateOrCreate');
Route::get('/article/delete', 'ArticleController@delete');
Route::get('/article/destroy', 'ArticleController@destroy');
Route::get('/article/index', 'ArticleController@index');


Route::get('/route', 'IndexController@route');
Route::post('/route', 'IndexController@route');

Route::resource('article', 'ArticleController');

Route::group([
    'prefix' => 'v1'
],  function(){
    Route::resource('photos', 'PhotoController', ['parameters' => ['photos'=> 'admin_user']]);
});

// Route::get('/test', 'IndexController@test');
// Route::get('/test/', 'IndexController@test');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/blade', function() {
    return view('blade');
});

//Passport
Route::get('/redirect', function(Request $request){

    //dump($request);exit;
    $query = http_build_query([
        'client_id' => 3,
        'redirect_url' => 'http://laravel.54/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('/oauth/authorize?' . $query);
});

Route::get('/homee', function(Request $request){

    $http = new GuzzleHttp\Client();

    $response = $http->post('http://laravel.54/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 3,
            'client_secret' => 'gKRXSmjWSIOVk3CNxHozkxFHzxt8kiykDGdEa2df',
            'redirect_callback' => 'http://laravel.54/callback',
            'code' => $request::get('code')
        ]
    ]);

    return json_encode( (string) $response->getBody(), true);
});

Route::get('home/test', "HomeController@test");


/*Route::group(['namespace' => 'Auth'], function(){
    Route::any('auth/resetpassword/test', 'ResetPasswordController@test');
});*/
Route::any('auth/resetpassword/test', 'Auth\ResetPasswordController@test');


Route::get('/front/index', 'FrontController@index');

Route::get('/user/{user}', function(App\User $user) {

    return $user->email;
})->middleware('auth:api');

Route::get('/articles', function(){
    return view('index');
})->middleware('can:listAll,App\Models\Article');

Route::get('email/{user}', function($user){
    $exitCode = Artisan::queue('email_cmd:send', [
        'user' => $user,
        '--time' => 8
    ]);
    dd($exitCode);
});
Route::get('storages', 'IndexController@storage');
Route::post('storages', 'IndexController@storageUpload');

Route::get('notification', 'NotificationController@index');