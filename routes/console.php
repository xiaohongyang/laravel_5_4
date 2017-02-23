<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('email:send    {user=2}
                                {--field=id}
                                {--queue=Whether the job should be queued}',
    function( $user, $field, $queue){
        $user = \App\User::find($user);
        echo 'Send Email To : ' . $user->email ."\n";
        echo $field . "\n";
        echo $queue . "\n";
})->describe('send email to user');

//arg* receive input array e.x:(php artisan print:array 1 2 3 4 5)
Artisan::command('print:array {arg*}', function($arg){
    print_r($arg);
    echo "\n";
})->describe('receive and print array input arrays');

