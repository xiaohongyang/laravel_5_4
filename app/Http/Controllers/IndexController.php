<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

 

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
 

 

//class IndexController extends BaseController
class IndexController extends Controller
{
    

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
