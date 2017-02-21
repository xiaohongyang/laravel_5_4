<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/21
 * Time: 6:15
 */

namespace App\Http\Controllers;


class FrontController extends Controller
{

    public function index(){
        return view('front.index');
    }

}