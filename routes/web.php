<?php


Auth::routes();

Route::resource('photos', 'PhotoController');

Route::get('redirect', function (){
    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => env('APP_URL') .'/articles',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('/oauth/authorize?' . $query);
});


Route::get('redirect_home', function (){

    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => env('APP_URL') .'/home',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('/oauth/authorize?' . $query);
});

Route::get('redirect_callback', function(){
    $query = http_build_query([
        'client_id' =>2,
        'redirect_uri' =>  env('APP_URL') . '/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('/oauth/authorize?' . $query);
});



Route::get('callback', function (\Illuminate\Http\Request $request){
    $http = new GuzzleHttp\Client();
    $response = $http->post(env('APP_URL') .'/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '2',
            'client_secret' => 'tSsBsberWnXfosQGU5az3H3HQXTHJQ7dAE7x4EWT',
            'redirect_uri' => env('APP_URL') .'/callback',
            'code' => $request->code
        ]
    ]);
    return json_decode( (string)$response->getBody(), true);
});

Route::get('refreshToken', function(){

    $user = \App\User::where('id',2)->first();
//    dump($user->access_token);
//    dump($user);
//    dump($user->refresh_token);exit;

    $http = new GuzzleHttp\Client();

    $response = $http->post(env('APP_URL') .'/oauth/token', [
        'form_params' => [
            'grant_type' => 'refresh_token',
            'refresh_token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijg3MGI3ZWQ5ZWE3NGE2MWM0ODhhZDBiYzRkZjQzMGM0MTc0YWY4OTcxNGJlMjY5MzA3NDFmYjIwNTFiMzdhYTRiM2FhMDRiNDNiYjJlMzgzIn0.eyJhdWQiOiIzIiwianRpIjoiODcwYjdlZDllYTc0YTYxYzQ4OGFkMGJjNGRmNDMwYzQxNzRhZjg5NzE0YmUyNjkzMDc0MWZiMjA1MWIzN2FhNGIzYWEwNGI0M2JiMmUzODMiLCJpYXQiOjE0OTYwNjg3NzksIm5iZiI6MTQ5NjA2ODc3OSwiZXhwIjoxNTI3NjA0Nzc5LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.xekXM8nvvDn0cnsEOgNOBIsSXJtY_0o2DLHHfNRBbMQ7wvKRXw-qyCvEarnwBQNKAO_36tRSuIKGRUAtTbdP5cr2fef7-72MK1ktNZ_xUMkr8sWClpL-aacjjHk0TG3ao6EVDjbZr07UshOXmmEoUX8PAGfKH_uAL7PDGTXdRJ68hOpVzFuA1Ke7p3BCjEpIqHf3h80C3VooCGiIZdMrQI8c3AxsaSAhICcKTN6CbrZIZnT6sgwr1-OXVFU1WqmjMWR3FqzQY41YS_JzoDyKeDveJOzowUPxD2d8_nJfN8tAi2ntKlARVyQCeiLkpkl3o3kHR6ej8eWF4P4fNzI3wCFTJ3SghP0kczF7-N1MkJjXyjJZh4U1_-UXsHFVXn3fvXixDBIygILFamAVwHUOCc3BVIIERdv81eUxWQXjyPHU0WeHTvjuCGU7O8jjf6sYw9KlSFy-6aiK8-U5iHCx9Wl8fMKOT2qHcwxnr5heGCu886tUOLNGokjkBIqq6inoZQnStiX3jDze7GVdiXP7a6cPTnxr0odBG9JVx9GP5tFEjj58mB5aSYF_uTWZwEVrKJ-iVEQ0930dFp7ofk4_9bnSnTWxqBu5iQ4dk98wlfmlWFTyhzFIqf9CMLXdRJ19YselryCzH3mD_EfCHBMfrXWGytDTbNB97N1ZzfmUXl4',
            'client_id' => 5,
            'client_secret' => 'nnAzR3Is4IsQTrSmn6Yk78uKDgiGjWQ0wQ8bGJDG',
            'scope' => ''
        ]
    ]);

    return json_decode( (string)$response->getBody() , true);
});

Route::get('passwordToken', function(Request $request){

    $user = \App\User::where('email', 'JackXiao@qq.com')->first();
    // echo $user->email;exit;
    $http = new GuzzleHttp\Client();

    $response = $http->post(env('APP_URL') .'/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '5',
            'client_secret' => 'nnAzR3Is4IsQTrSmn6Yk78uKDgiGjWQ0wQ8bGJDG',
            'username' => $user->email,
            'password' => '321321',
            'scope' => '',
        ],
    ]);

    return json_decode( (string)$response->getBody(), true );
});

Route::get('implicitGrantToken', function(){

    $query = http_build_query([
        'client_id' => '27',
        'redirect_uri' => env('APP_URL') .'/home',
        'response_type' => 'token',
        'scope' => '',
    ]);

    return redirect(env('APP_URL') .'/oauth/authorize?' . $query);
});

Route::get('clientCredentialsGrantToken', function(){

    $http = new GuzzleHttp\Client();
    $response = $http->post(env('APP_URL') .'/oauth/token', [
       'form_params' => [
           'grant_type' => 'client_credentials',
           'client_id' => 27,
           'client_secret' => '672magxcDiF6cg4eAxFLzu7XSEr3ADrk7sz7dX7T',
           'scope' => ''
       ]
    ]);

    return json_decode( (string)$response->getBody(), true );
});

Route::get('getToken', function(\Illuminate\Http\Request $request){

    $data = [
        'status' => 500,
        'token' => ''
    ];
    $key = $request->get('key');
    if($key == env('APP_KEY')) {
        $user = \App\User::where('id', env('TEST_USER_ID'))->first();
        $token = $user->createToken(env('APP_URL'))->accessToken;
        $data = [
            'status' => 200,
            'token' => $token
        ];
    }
    return $data;
});

Route::get('/', 'IndexController@index');
Route::get('index', 'IndexController@index');
#region UserCenter

    Route::get('/home', 'UserCenter\UserCenterController@index')->name('home')->middleware(['auth']);

#endregion

#region 前端文章展示
    Route::get('articles', 'ArticleController@index');
    Route::get('article/{id}', 'ArticleController@item');
#endregion

#region 文章管理

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/user/article/list', 'UserCenter\ArticleController@list')->name('user-article-list');
        Route::get('/user/article/create', 'UserCenter\ArticleController@create')->name('user-article-create');
        Route::post('/user/article/create', 'UserCenter\ArticleController@create')->name('user-article-create');
        Route::get('/user/article/edit', 'UserCenter\ArticleController@edit')->name('user-article-edit');
        Route::get('/user/article/del', 'UserCenter\ArticleController@del')->name('user-article-del');
        Route::get('/user/article/discuss/list', 'UserCenter\ArticleController@discussList')->name('user-article-discuss-list');
    });

    Route::get('uploadimage', 'IndexController@uploadimage');
    Route::post('douploadimage', 'IndexController@douploadimage')->name('douploadimage');
#endregion

/*Route::get('/test', function(){
    $type = new \App\Models\ArticleTypeModel();
    $type->create("linux");
    return 'test';
});*/

Route::get('/create', function(\Illuminate\Http\Request $request){

    $article = new \App\Models\Article();

    $typeName = $request->get('type_name');
    $typeItem = \App\Models\ArticleTypeModel::where(['name' => $typeName])->first();
    if (is_null($typeItem)) {
        $typeItem = new \App\Models\ArticleTypeModel();
         $typeItem->create($typeName);
    }

    $request->merge(['type_id'=>$typeItem->id]);

    $result = $article->createOrEdit($request);
    var_dump($result);
    print_r($request);
});

Route::post('/create', function(\Illuminate\Http\Request $request){

    $article = new \App\Models\Article();

    if($request->has('title')){
//        $request->merge(['title' => strip_tags($request->get('title'))]);
        $request->merge(['title' => trim(strip_tags($request->get('title'))) ]);
    }

    $typeName = $request->get('type_name');

    $typeItem = \App\Models\ArticleTypeModel::where(['name' => $typeName])->first();
    if (is_null($typeItem)) {
        $typeItem = new \App\Models\ArticleTypeModel();
         $typeItem->create($typeName);
    }
    $request->merge(['type_id'=>$typeItem->id]);

    $result = $article->createOrEdit($request);
    var_dump($result);exit;

    var_dump($result);
});



Route::get('queue_test', function(\Illuminate\Http\Request $request){

    $id = $request->get('id');
    $user = \App\User::find($id);
    $job = (new \App\Jobs\TestJob($user));

    \dispatch($job->onConnection('redis')->delay(\Carbon\Carbon::now()->addSeconds(30)));
});