<?php

namespace App\Http\Controllers;

use App\Notifications\InvoicePaid;
use App\Notifications\InvoicePaidMarkDown;
use App\User;
use Carbon\Carbon;
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
        //$rs = \Notification::send($user, new InvoicePaid()));
        //$when = Carbon::now()->addMinutes(10);
        //$rs = $user->notify((new InvoicePaid())->delay($when));
        //dump($rs);
        //3. Markdown Mail Notifications
        //$user->notify(new InvoicePaidMarkDown($user));

//        $collections = $user->unreadNotifications ;
//        foreach ($collections as $collection){
//
//            if($collection->id == 'ff958ff0-2fb8-4917-b954-20112473421e'){
//                //$rs = $collection->markAsRead();
//                $collection->markAsRead();
//                var_dump($collection);
//            }
//        }

        //4.
        $user->notify(new InvoicePaid());

    }

    public function listen(){
        return view('notification.listen');
    }
}
