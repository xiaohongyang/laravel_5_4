<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/14
 * Time: 9:42
 */

namespace App\Listeners;
use App\Events\ArticleReleased;


class SendArticleReleasedNotification
{
    public function __construct()
    {
    }

    /**
     * handle event
     * @param ArticleReleased $event
     */
    public function handle(ArticleReleased $event){

        print_r($event->article->author);
    }

}