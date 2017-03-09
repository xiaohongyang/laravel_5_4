<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        return view('home');
    }

    public function test(){



//        if(!cache("name")) {
//            cache( ['name' => Auth::user()->email], Carbon::now()->addMinutes(10));
//        }
//        dump(cache("name"));
//
//        if(!cache('uid')){
//            dump("uid not exist!");
//            cache(['uid'=>11], Carbon::now()->addSeconds(3));
//        } else {
//            dump("uid exist!");
//        }
//
//        Cache::put("test", 321, Carbon::now()->addMinute(10));
//        dump(Cache::get("test"));
//        dump(Cache::get("uid"));

        //Cache::flush();

//        Cache::store("database")->put("name", "Xiaohongyang", Carbon::now()->addMinute(2));
//
//        dump(Cache::get("name"));
//
//        dump(date('Y-m-d H:i:s', 1488447951));

        $r = collect([1,2,3,5,6,8, 'jack'])->max();
        $r = collect([1,2,3,5,6,8, 'jack'])->min();
        dump($r);

    }
}
