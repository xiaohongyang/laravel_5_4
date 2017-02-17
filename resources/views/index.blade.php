<?php
use Carbon\Carbon;use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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


