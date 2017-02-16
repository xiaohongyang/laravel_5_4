<?php

namespace App\Http\Controllers;

use App\Events\ArticleReleased;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Scopes\AuthorScope;
use App\Scopes\DeletedScope;
use Illuminate\Support\Facades\Event;

class ArticleController extends Controller
{
    //

    private $article;

    public function __construct(Article $article){
        $this->article = $article;
    }

    public function index(Request $request){

        $articleList = $this->article->getList();
        return view('article.index', [
            'articleList' => $articleList
        ])->with('name', 'JackXiao');
    }

    public function create(Request $request){
        //print_r($request);

        $rs = Article::create(['title'=>'test', 'author'=>'xhy']);

        event(new ArticleReleased($rs));
        exit;
        var_dump($rs->author);
//        $rs->fill(['author'=> 'xjp','aa','title'=>'testvvv']);
//        $rs->save();
        var_dump($rs->author);

        exit;

        $articleModel = new Article();
        $rs = $articleModel->store($request);
        var_dump($rs);
    }

    public function firstOrCreate(Request $request){
        $articleModel = new Article();
        $rs = $articleModel->doFirstOrCreate($request);
        var_dump($rs);
	}
    public function firstOrNew(Request $request){
        $articleModel = new Article();
        $rs = $articleModel->doFirstOrNew($request);
        var_dump($rs);
	}


    public function updateOrCreate(Request $request){
        $articalModel = new Article();
        $rs = $articalModel->doUpdateOrCreate($request);
        var_dump($rs);
    }

    public function delete(Request $request){
        $articleModel = new Article();
        $rs = $articleModel->doDelete($request);
        var_dump($rs);
    }

    public function destroy(Request $request){
        $articleModel = new Article();
        $rs = $articleModel->doDestroy($request);
        var_dump($rs);
    }

    public function batchDelete(){

    }

}
