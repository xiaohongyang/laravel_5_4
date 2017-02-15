<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/14
 * Time: 9:36
 */

namespace App\Events;
use App\Models\Article;
use Illuminate\Queue\SerializesModels;

class ArticleReleased
{
    use SerializesModels;

    public $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
        printf("文章发布Event<br/>");
    }

}