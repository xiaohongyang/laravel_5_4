<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPodcast;
use App\Models\Article;
use App\Models\ArticleSpiderModel;
use App\User;
use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Cache;

 

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use GuzzleHttp;

//class IndexController extends BaseController
class IndexController extends Controller
{
    
	public function index(Request $request){

	    $http = new GuzzleHttp\Client();

        $accessToken = 'K1hgw2ZMxsDHMGyoBbQVKtdVydFA8zilCaRphzTmArpjEw47HCGd6tkGy0E2';

//        $response = $http->request('GET',  env('APP_URL') .'/api/user', [
//            'Accept' => 'application/json',
//            'Authorization' => 'Bearer '.$accessToken,
//        ]);

        try {
        	/*$url = env('APP_URL') .'/home';
        	$api_token = $accessToken;
        	$guzzle = new GuzzleHttp\Client();
        	$response = $guzzle->request('get', $url, ['api_token' => $api_token]);	*/
        } catch (Exception $e) {
        	
        	print_r($e->getMessage());
        }
        



//        echo json_decode( (string)$response->getBody(), true );
//exit;
		//Log::info("test");
		//Log::error("error",['name'=>"jack"]);

		//abort(403, 'Unauthorized action.');
//		$job = new ProcessPodcast(User::find(2));
//
//		$job->onconnection('redis');
//		$job->delay(Carbon::now()->addSeconds(2));
//		$r = dispatch($job);
//
//		//$r = event($job);
//
//		echo date("Y-m-d H:i:s");
//
//		dump($r);
//		exit;

//		$user = ['email' => '258082291@qq.com' , 'subject' => 'test'];
//		\Mail::send('403',  $user , function($message) use (&$user)
//		{
//			$message->from($user['email'], 'name')
//				->to('258082291@qq.com', 'contact us')
//				->subject($user['subject']);
//		});
//
//		exit;

		//\App::setLocale('zh');
        //echo 33;exit;
        //$model01 = ArticleSpiderModel::getSingle("http://6846041.blog.51cto.com/6836041/1439443");
        //$content01 = $model01->getContents();
        //$model = ArticleSpiderModel::getSingle("http://laravel.54/home");
        //$body = $model->getContents();
//        $rs2 = $model->statusCode;
//        echo $rs2;
//        echo $body;
//        echo iconv('gbk', 'utf-8',  $content01);
		return view('index');

		/*$articles = Article::all()->where('id', '>', 0)->take(3);

		$articles->reject(function($model) {
			print_r($model);
			echo '<hr/>';
		});

		echo '44'.'<br/>';
		print_r(Article::where('id', '>', 0)->firstOrFail());
		echo '44555555555'.'<br/>';


		$max = Article::where('id', '>', 0)->max('id');
		print_r($max); exit;
		echo 'max:' . $max[0]->title;

		Article::chunk(1, function($articles){
			foreach( $articles as $article ) {
				print_r($article);
				echo '<hr/>';
			}
		});

		//use cursor()方法
		foreach( Article::where('id', '>', 0)->cursor() as  $article) {
			print_r($article);
			echo "<hr/>";
		}*/
	}

	public function route(Request $request){

		//if the incoming request is targeted at http://domain.com/foo/bar, the path method will return foo/bar:
//		dump($request->path());
//		dump($request->is('rout*'));
//		dump($request->url());
//		dump($request->fullUrl());
//		//return the request method , like 'get'、'post' ...
//		dump($request->method());
//		dump($request->get('a'));
//		dump($request->input('a'));
//		dump($request->all());
//		dump($request->input('ab','a'));
//		dump($request->only('a','c'));
//		dump($request->except('a'));
//		dump($request->intersect(['a','b']));
		return view('route');
	}

	/**
	 * get current action method name
	 * @author 258082291@qq.com
	 * @return mixed
	 */
	protected function getCurrentActionName(){
		$currentRoute = Route::getCurrentRoute()->getActionName();
		list(, $action) = explode('@', $currentRoute);

		return  $action;
	}

	/**
	 * get current controller name
	 * @return mixed
	 */
	protected function getCurrentControllerName(){
		$currentRoute = Route::getCurrentRoute()->getActionName();
		list($controller,) = explode('@', $currentRoute);
		$controllerArr = explode('\\', $controller);
		$controllerName = array_pop($controllerArr);
		return  $controllerName;
	}

	/**
	 * get current namespace
	 */
	protected function getCurrentNameSpace(){
		$currentRoute = Route::getCurrentRoute()->action['namespace'];
		echo $currentRoute;
	}

    public function test(){

        echo 33;exit;
		if(App::environment('local')) {
			echo 'is local';
		} else if(App::environment('develop')){

			echo 'is develop';
		} else {
			echo 'is not local';
		}

		echo env('app.timezone');
		echo config('app.timezone');

		echo '<br/>';
		echo date('Y-m-d H:i:s', time());

		echo 3;
    }


    public function storage(){

        echo asset('storage/test.txt');
        \Storage::disk('local')->put('test.txt',"Contents");
        echo \Storage::disk('local')->get('test.txt');
        return view('index.storage');
    }

    public function storageUpload(Request $request){

        $path = \Storage::putFileAs("headpic", $request->file('headpic'),'test.jpg');
        $path = \Storage::putFile("headpic", $request->file('headpic'));
        echo $path;
        $path = $request->file('headpic')->storeAs('headpic', '001.jpg');
        echo $path;
        \Storage::setVisibility('headpic/001.jpg', 'public');

        if(\Storage::exists('headpic/ltIY6ALVzWv9MXZz1WUE3Z1CIfgA7oTH0pvdEhDU.jpeg')){
            \Storage::delete('headpic/ltIY6ALVzWv9MXZz1WUE3Z1CIfgA7oTH0pvdEhDU.jpeg');
        }
        if(!\Storage::exists('new_directory')){
            \Storage::makeDirectory('new_directory');
        }
        exit;

    }


    public function uploadimage() {
        return view('index.uploadimage');
    }

    public function douploadimage(Request $request) {

        //获取上传文件和文件信息

        $directoryHeadPic = env('HEAD_PIC_FILE_PATH');
        $articleThumbFilePath = env('ARTICLE_THUMB_FILE_PATH');
        //图片保存路径
        $directoryArray = [$directoryHeadPic, $articleThumbFilePath];
        $directory = implode(',', $directoryArray);

        $rules = ['thumb' => 'required|max:101','directory' => 'required|in:' . $directory];
        $validate = \Validator::make($request->all(), $rules);
        $file = Input::file('thumb');

        $result = ['result' => false, 'errors' => []];
        //验证文件信息
        if (!is_null($file) && !$validate->fails()) {

            //保存文件
            $extension = $file->getClientOriginalExtension();
            $filePath = public_path() . DIRECTORY_SEPARATOR . $request->get('directory') . DIRECTORY_SEPARATOR;
            $fileName = date('YmdHis',time());
            $fileName .= '.' . $extension;
            $file->move($filePath, $fileName);
            $result['result'] = true;
            $result['file'] = $request->get('directory'). DIRECTORY_SEPARATOR . $fileName;
        } else {

            $result['errors'] = $validate->errors();
        }
        return $result;
    }

}
