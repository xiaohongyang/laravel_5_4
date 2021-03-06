<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPodcast;
use App\Models\Article;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

 

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
//class IndexController extends BaseController
class IndexController extends Controller
{
    
	public function index(){


		Log::info("test");
		Log::error("error",['name'=>"jack"]);

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

		\App::setLocale('zh');
		return view('index');

		$articles = Article::all()->where('id', '>', 0)->take(3);

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
		}
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

}
