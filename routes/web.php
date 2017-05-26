<?php


Auth::routes();

Route::resource('photos', 'PhotoController');

Route::get('redirect', function (){
    $query = http_build_query([
        'client_id' => '14',
        'redirect_uri' => env('APP_URL') .'/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('/oauth/authorize?' . $query);
});

Route::get('callback', function (\Illuminate\Http\Request $request){
    $http = new GuzzleHttp\Client();
    $response = $http->post(env('APP_URL') .'/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '14',
            'client_secret' => 'HscsLczaEoDzgQkXhvBrA0odBWlRyJyILF9DkoSQ',
            'redirect_uri' => env('APP_URL') .'/callback',
            'code' => $request->code

        ]
    ]);

    return json_decode( (string)$response->getBody(), true);
});

Route::get('refreshToken', function(){

    $user = \App\User::where('id', 1)->first();
//    dump($user->access_token);
//    dump($user);
//    dump($user->refresh_token);exit;

    $http = new GuzzleHttp\Client();
    $response = $http->post(env('APP_URL') .'/oauth/token', [
        'form_params' => [
            'grant_type' => 'refresh_token',
            'refresh_token' => '0litnDIrJdTLOH337wjMwU\/izJpiaUIl1UkzvHarOHqFIowdrvW1QlafGbDqxJsUJykfUowk80QbpqRsW7qNQvkqKekb92q6HYpJNP58hcGdj2KJkM3ZzMv8m006vMCsSbpvScYAT+NAmspuM\/feGE7Y+mtd+wPcINeZGJMxw7atqrlk+ulUsdoPOb+8Paa0CXgAzFB\/MjjfHV3nEHwFDL3qd3yhL0ZY0rCteRut4l9ATRUdtf8hGJoFR8peQDwRP5Chqtf4ISYfyl6HnDC6ziEScWeE327uDcr\/D\/ACrL+44T6CJ1q3alDEfLUo5lc1ob07yKobxPbWt2Mse9sPKUC1+T6owMjsBTBGNL5nddRazX0i\/5jh+N3jx0zizOOzNqe+JJZaK9VmZPBm0Ku4Y6Dd\/kMygCpIuAuD7gaQVWiZpBl3a98ZK2XwJ5hTN793jicn1daXsuVV4bypdC6pwRf55LEXUNAx948cgzzfYx6PFrppRoi7hvq6AiD09DcyBA51Urjy2d8UrtYS6W8HeTyNHvGoMQXCXbjuDT+jHtEGFpWIjSSCpr+QvWLD9xHXYkfx+8STsljr0rEejsIRr1DodmQASmob6iX2HA9XNHy76ykYv74JCJ2paiOLGsWm\/C3Qom7ZLZQ5rck10XQ+qZnWMaOjFEJVoDuCpcKnOVg=',
            'client_id' => 14,
            'client_secret' => 'HscsLczaEoDzgQkXhvBrA0odBWlRyJyILF9DkoSQ',
            'scope' => ''
        ]
    ]);

    return json_decode( (string)$response->getBody() , true);
});

Route::get('passwordToken', function(Request $request){

    $user = \App\User::where('email', '2447391779@qq.com')->first();

    $http = new GuzzleHttp\Client();
    $response = $http->post(env('APP_URL') .'/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '27',
            'client_secret' => '672magxcDiF6cg4eAxFLzu7XSEr3ADrk7sz7dX7T',
            'username' => $user->email,
            'password' => 'abcabc',
            'scope' => '*',
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

Route::get('personalAccessToken', function(){
    $user = \App\User::where('id', 4)->first();
//    $token = $user->createToken('xhy_personal_access_client')->accessToken;
//    dump($token);
//
//    exit;
    $token = $user->createToken('3333')->accessToken;
    dump($token);
});

Route::get('/', 'IndexController@index');
Route::get('index', 'IndexController@index');
#region UserCenter

    Route::get('/home', 'UserCenter\UserCenterController@index')->name('home');

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

