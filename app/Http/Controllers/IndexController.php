<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

 

//class IndexController extends BaseController
class IndexController extends Controller
{
    

    public function test(){

    	if (Cache::has('name') ){
    		sprintf("name=" . Cache::get('name', 'default
    			'));
    		 
    		echo Cache::get('name');
    	} else {
    		sprintf("name不存在");
    		// Cache::add('name', 'jack xhy');
    		Cache::add('name', 'jack xhy', 20);
    	}

    	echo 33;exit;
    }

}
