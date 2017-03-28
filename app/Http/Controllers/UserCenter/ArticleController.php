<?php

namespace App\Http\Controllers\UserCEnter;

use App\Forms\ArticleForm;
use App\Models\Article;
use App\Models\ArticleSearchModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;

class ArticleController extends BaseUserController
{
    //

    /**
     * 文章列表
     */
    public function list(\Request $request){

        $model = new ArticleSearchModel();
        $articleList = $model->getList($request);

        return self::getXhyView(['articleList' => $articleList]);
    }

    /**
     * 创建文章
     */
    public function create(FormBuilder $formBuild, \Request $request){

        $article = new Article();
        if ($request::method() == 'POST') {

            $form = $formBuild->create(ArticleForm::class);
            if(!$form->isValid()) {
                return redirect()->back()->withErrors($form->getErrors())->withInput();
            }

            $rs = $article->create($request);
            if ($rs) {
                return redirect()->route('user-article-list');
            } else {
                return back();
            }
        } else {

            $data = [];
            if ($request::get('id')) {
                $article = Article::find($request::get('id'));
                $data['contents'] = "321abc"; //$article->detail()->contents;
            }

            $form = $formBuild->create(ArticleForm::class, [
                'method' => 'post',
                'url' => route('article-create')
            ], $data);
        }
        //return self::getXhyView();
        return self::getXhyView(['article' => $article, 'form' => $form]);
    }

    /**
     * 文章编辑
     */
    public function edit(\Request $request){

        $articleId = $request::get('id');
        $article = Article::find($articleId);

        return self::getXhyView(['article' => $article]);
    }

    /**
     * 文章删除
     */
    public function del(){
        return "del";
    }

}
