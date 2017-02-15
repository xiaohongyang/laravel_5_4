<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

 

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


//class IndexController extends BaseController
class IndexController extends Controller
{
    
	public function index(){

		$this->getCurrentActionName();
		exit;

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




}
