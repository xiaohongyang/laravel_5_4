<?php

namespace App\Http\Controllers\UserCenter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCenterController extends BaseUserController
{
    //

    public function index(){

        return self::getXhyView();
    }
}
