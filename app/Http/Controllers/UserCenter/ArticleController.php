<?php

namespace App\Http\Controllers\UserCEnter;

use App\Forms\ArticleForm;
use App\Models\Article;
use App\Models\ArticleSearchModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
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
    public function create(FormBuilder $formBuild, Request $request){




        $article = new Article();
        if ($request->method() == 'POST') {

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

            $article = $request->get('id') ? Article::find($request->get('id')) : null;
            $form = $formBuild->create(ArticleForm::class, [
                'method' => 'post',
                'url' => route('user-article-create'),
                'model' => $article
            ]);

            $user = \Auth::user();

            $cate = Gate::forUser($user)->allows('update-article', $article);
            //dump($cate);
            //dump(Gate::forUser($user));


            $rs = $user->can('update', $article);
            //dump($rs);
        }
        //return self::getXhyView();
        return self::getXhyView(['article' => $article, 'form' => $form]);
    }

    public function create2(Request $request) {
        return self::getXhyView();
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
    public function del(Request $request){

        $data = $request->all();
        $validator = new \Validator();
        if ($validator::make($data, ['id'=>'required'])->passes() ){

            $article = new Article();
            $rs = $article->doDelete($data['id']);
            if ($rs) {

                $request->session()->flash('message', '删除成功!');
            } else {
                $request->session()->flash('message', '删除失败!');
            }
        } else {
            $request->session()->flash('message', '参数错误!');
        }
        return redirect()->back();
    }

    public function discussList() {
        return 'discuss list';
    }

}
