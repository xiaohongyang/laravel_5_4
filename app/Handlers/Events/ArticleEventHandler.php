<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/15
 * Time: 8:49
 */

namespace App\Handlers\Events;
use App\Events\ArticleDestroyed;
use Illuminate\Events\Dispatcher;


class ArticleEventHandler
{

    /**
     * 处理文章发布事件
     * @param $event
     */
    public function onArticleReleased($event) {
        print_r("文章发布事件订阅!!");
    }

    public function onArticleDestroyed(ArticleDestroyed $event){
        Log($event->article->id . 'destroyed');
    }

    public function subscribe(Dispatcher $events) {
        $events->listen('App\Events\ArticleReleased', 'App\Handlers\Events\ArticleEventHandler@onArticleReleased');
    }
}