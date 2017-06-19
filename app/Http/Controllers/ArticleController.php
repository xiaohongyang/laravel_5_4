<?php

namespace App\Http\Controllers;

use App\Events\ArticleReleased;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Scopes\AuthorScope;
use App\Scopes\DeletedScope;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ArticleController extends Controller
{
    //

    private $article;

    public function __construct(Article $article){
        $this->article = $article;
    }

    public function index(Request $request){

        /*$articleList = $this->article->getList();

        if (\Gate::allows('list', Article::class)) {

            $articleList = $this->article->getList();
            return view('article.index', [
                'articleList' => $articleList
            ])->with('name', 'JackXiao');
        } else {
            return view('403');
        }*/
        return view ('article.index');

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

    public function store(Request $request){
        info($request);
        //sometimes 只有在该字段在数据中存在才做验证
//        $this->validate($request, [
//            'title' => ['sometimes', 'required' ],
//            'author' => 'required | email'
//        ],[
//            'title.required' => '标题不能为空',
//            'title.exists' => '标题不存在'
//        ],['author'=>'作者']);

        $validate = \Validator::make($request->all(), [
            'title' => ['required'],
            'author' => 'required'
        ]);

        $validate->sometimes('author', 'required', function($input){
            return $input->title == '334455';
        });

        //当author的值为'jack'的时候，title必须为'xiao01'或者'xiao02'
        $validate->sometimes('title', Rule::in(['xiao01','xiao02']), function($input) {

            return $input->author=='jack';
        });

        $validate->addRules( ['title'=> 'CustomerStrLess3']);




        $validate->validate();

        $this->article->create($request);
        $request->session()->flash('msg', '添加成功');
        return back();
    }

}
