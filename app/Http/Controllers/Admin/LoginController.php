<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    //

    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dash';

    protected $username;


    public function __construct()
    {
       // $this->middleware('auth.admin', ['except' => ['showLoginForm']]);
        $this->middleware('auth.checkIsAdmin', ['except' => ['logout']]);
    }

    public function username()
    {
        return 'email';
    }

    public function test(){
        echo 'test';
    }

    public function showLoginForm()
    {
        return view('admin.login.login');
    }

//    public function login(Request $request)
//    {
//        return pa
//    }


    protected function guard()
    {
        return auth()->guard('admin');
    }




}
