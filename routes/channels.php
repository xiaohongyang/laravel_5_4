<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Models\Article;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

/*Broadcast::channel("article.{articleId}", function($user, $articleId){
    return $user->id === Article::find($articleId)->user_id;
});

Broadcast::channel("article", function($user){
    return true;
});
Broadcast::channel("articlexhy", function($user){
    return $user;
});

Broadcast::channel('order.{orderId}', function ($user, $orderId) {
    return true;
});*/

//Broadcast::channel('chat-room', function ($user) {
//    return true;
//});
//Broadcast::channel('chat-room.{messageId}', function ($user, $messageId) {
//    return true;
//});

Broadcast::channel("chat-room", function($user){
    //\Log::info("chat-room channel", ['user_id' => $user->id, 'time' => \Carbon\Carbon::now()]);
    return true;
});


//Broadcast::channel('chat-room.{id}', function ($user, $id) {
//    return true;
//});