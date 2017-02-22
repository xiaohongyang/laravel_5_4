<?php
use Carbon\Carbon;use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
?>

@extends('layouts.app')

@section('content')

    {{Hash::make('123')}} <br/>
    {{Hash::make('123') == Hash::make(123) ? '=' : '!='}} <br/>
    {{Hash::check('123', '$2y$10$GFjcDwClit2XxfbMNxoINuJvDIPssNZ0MtPEJBBGQk7t6HEC5tXYC')}} <br/>
    {{Hash::check('123', '$2y$10$xykSvVv.9PawV.HwoOo2luVPH1wEA1QcRNvkkNoBMAhz1WzmtFSua')}} <br/>


    encrypt(123)=
    {{encrypt('123')}} <br/>
    Crypt::decrypt():{{Crypt::decrypt('eyJpdiI6IldZUmF0U1BXQVpoUDhvdFc3b0RNa2c9PSIsInZhbHVlIjoiWnp4Qk5KR1ZhVXQyc1lyc2J4WWdJQT09IiwibWFjIjoiN2YxZmJjNmNlZTg4NWQzOTY3NjA1NjRkMmJmYzM4OWJjMmQ2NzkwY2RkNGEwODE1ZTdiMzM0Yzk4OWU2OTY2NiJ9 ')}} <br/>

    Crypt::encryptString(): {{Crypt::encryptString('123')}} <br/>
    Crypt::decryptString(): {{Crypt::decryptString('eyJpdiI6IlY1SzJITVlaQjIxUkRSVVNTcGtDNkE9PSIsInZhbHVlIjoib2xOeUc3T3F5QzM0WWNOQ3YzTmtKQT09IiwibWFjIjoiYjMxMmE1MGMyMWIzZjRlYTZhYmMzZmNiNjcyZGZhZmU0YTQ2NTBiYTRhMjVmOGM2ODYzY2E4MTk1ZmY1MGNlYyJ9 ')}} <br/>

    <?php

            try {
                $decrypted = decrypt('eyJpdiI6ImZmZktLaENsSzlEU2JCOXFRZzFrR2c9PSIsInZhbHVlIjoiUjd5RGI3dDVieGJDb0xJM1lITzRHdz09IiwibWFjIjoiNGRjZjFkZmM2MDA5NWQzNTQ0ZGMzYzM3MGYxNDFkNzkxZTU2NTFjNzZiMmIxYjY0N2ZiM2Y2YzU1NTI2NDRmMSJ9 ');
            } catch (DecryptException $e) {
                //
            }

    ?>

    <?php
    //info("some useful information!");
    echo __('messages.welcome', ['name'=>'JackXiao']); echo '<br/>';
    echo trans_choice('messages.apples',1); echo "<br/>";
    echo trans_choice('messages.apples02', 3);
    dump("abc");
    dump(Carbon::now());
    dump(Carbon::now()->addSeconds(10));

    if(!cache('uid')){
        dump("uid not exist!");
        cache(['uid'=>11], Carbon::now()->addSeconds(3));
    } else {
        dump("uid exist!");
    }

        dump (route('photos.create'));
        dump (route('photos.show', ['admin_user'=>1]));
        dump (route('photos.edit', ['admin_user'=>1]));
        dump (action('PhotoController@index', 1));
        dump (action('PhotoController@show',1));

        dump (action('PhotoController@index', ['photos'=>44]));

        dump(asset('img/photo.jpg'));

        dump(str_random(2));
        dump(str_is("肖*阳", "肖红阳"));
        echo str_limit("我是中国人,I'm Chinese!", 12);

        dump(public_path());
        dump(resource_path('33'));
        dump(database_path());
        dump(app_path());
    ?>



    <br/>
    <?=url()->full()?>

    <br/>
    <?=url()->current()?>

@endsection
