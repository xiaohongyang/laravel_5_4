<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Scopes\AuthorScope;
use App\Scopes\DeletedScope;

class ArticleController extends Controller
{
    //

    public function index(Request $request){


        $list = Article::withoutGlobalScopes([
            DeletedScope::class, AuthorScope::class
        ])->get();
        print_r($list);


        $forceDeleteRow = Article::where('id', 5)->first();
        if($forceDeleteRow) {
            var_dump($forceDeleteRow->doForceDelete());
        }


        $one = Article::where('id',7)->first();

        if($one && !$one->trashed()) {

            $one->delete();
            print_r($one);
            echo "<hr/>";
            echo $one->trashed() ? '已删除' : '未删除';
            echo '<hr/>';
        }

        $articleModel = new Article();

//        $articleDeleted = Article::onlyTrashed()->first();
//        $rs = $articleDeleted && count($articleDeleted) && $articleDeleted->unDelete();
//        var_dump($rs);
//        echo '<hr/>';


        //
        $onlyTrashedData = $articleModel->getOnlyTrashed();
        $onlyTrashedData->reject(function($model){
           print_r($model);
           echo "<hr/>";
        });

        //
        $articleList = Article::where('id','>', '0')->withTrashed()->get();

        $articleList->reject(function($article){
            echo " $article->id  $article->title ".($article->trashed() ? '已删除' : '未删除')."<br/>";
        });
    }

    public function create(Request $request){
        //print_r($request);

        $rs = Article::create(['title'=>'test', 'author'=>'xhy']);
        var_dump($rs->author);
        $rs->fill(['author'=> 'xjp','aa','title'=>'testvvv']);
        $rs->save();
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
