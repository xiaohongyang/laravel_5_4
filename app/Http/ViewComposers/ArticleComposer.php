<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/16
 * Time: 14:15
 */

namespace App\Http\ViewComposers;
use App\Models\Article;
use Illuminate\View\View;

class ArticleComposer
{

    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * bind data to view
     * @param View $view
     */
    public function compose(View $view){
        $view->with('count', $this->article->count());
    }

}