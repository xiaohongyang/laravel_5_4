<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/14
 * Time: 8:57
 */

namespace App\Observer;
use App\Models\Article;

class ArticleObserver
{

    public function created(Article $article) {
        $article->author = 'observer';

        $article->save();
    }

    public function deleted(Article $article){

    }

}