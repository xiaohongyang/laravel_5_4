<?php

namespace App\Http\Controllers;

use App\Notifications\InvoicePaid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    //

    public function index(){
        $user = User::all()->first();
        //1. use notify() method
        //$rs = $user->notify( new InvoicePaid() );
        //dump($rs);
        //2. use Notification Facade
        $rs = \Notification::send($user, new InvoicePaid());
        dump($rs);

    }
}
