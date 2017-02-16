<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/2/16
 * Time: 14:24
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\View\ViewFinderInterface;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot(){

        \View::composer('article.index', 'App\Http\ViewComposers\ArticleComposer');
    }

}