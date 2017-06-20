<?php

namespace App\Http\Controllers\Api;

use App\Events\ArticleDestroyed;
use App\Models\Article;
use App\Models\ArticleTagsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $result = ['status' => 0, 'message'=>''];
        $model = new Article();


        try {
            $data = $model->getList($request);
            $result = [
                'status' => 1,
                'data' => $data
            ];
        } catch (Exception $e) {
        }
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return [
            'title',
            'thumb',
            'author',
            'user_id',
            'from_host',
            'type_id',
            'contents',
            'tags'
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $result = [
            'status' => 0,
            'message' => [],
            'id' => 0
        ];
        try {
                $data = [];
                $data['title'] = $request->get('title');
                $data['thumb'] = $request->get('thumb','');
                $data['author'] = $request->get('author');
                $data['user_id'] = \Auth::guard('api')->id() ;
                $data['from_host'] = $request->get('from_host', '');
                $data['type_id'] = $request->get('type_id');
                $data['contents'] = $request->get('contents');
                $data['tags'] = $request->get('tags');

                $article = new Article();
                $rs = $article->create($data);
                $result['id'] = $rs;
                $result['status'] = $rs ? 1 : 0;

                if(!$rs)
                    $result['message'] = $article->message;
        } catch (ValidationException $e) {
            $result['message'] = '';
            \Log::info($e->getMessage(). $e->getFile() . $e->getLine());
        } catch (Exception $e) {
            \Log::info($e->getMessage(). $e->getFile() . $e->getLine());
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        $type = $request->get('type');


        $result = ['status' => 0, 'message'=>'文章不存在'];
        $article = Article::with('detail', 'tags')->findOrFail($id);

        switch($type){
            case 1:
//                if($article->detail) {
//
////                    $contents = $article->detail->contents;
////                    unset($article->detail);
////                    $article->contents = $contents;
//                } else {
//                    $article->contents = "";
//                }

                if($article->tags){

                    foreach ($article->tags as &$tag){
                        $tag->name = ArticleTagsModel::find($tag->tag_id)->name;
                    }
                }
                break;
            default:
                break;
        }

        if( $article ) {
            $result['status'] = 1;
            $result['data'] = $article;
            $result['message'] = '获取信息成功!';
        }
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $result = [
            'status' => 0,
            'data' => [],
            'message' => ''
        ];
        $type = $request->get('type');
        $model = Article::find($id);

        if($model && $model->user_id == \Auth::guard('api')->id()) {

            switch ($type) {
                case 1:
                    if ($model->detail) {
                        $contents = $model->detail->contents;
                        unset($model->detail);
                        $model->contents = $contents;
                    }
                    if ($model->tags) {
                        foreach ($model->tags as &$tags) {
                            $tags->name = ArticleTagsModel::find($tags->tag_id);
                        }
                    }
                    break;
                default:
                    break;
            }
            $result['status'] = 1;
            $result['data'] = $model;
        } else if($model){
            $result['message'] = "您没有权限";
        }

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = [
            'status' => 0,
            'message' => [],
            'id' => 0
        ];
        try {

            $article = Article::find($id);

            $data = [];
            $data['title'] = $request->get('title');
            $data['thumb'] = $request->get('thumb','');
            $data['author'] = $request->get('author');
            $data['user_id'] = \Auth::guard('api')->id() ;
            $data['from_host'] = $request->get('from_host', '');
            $data['type_id'] = $request->get('type_id', $article->type_id);

            $rs = $article->edit($data);
            $result['id'] = $rs;
            $result['status'] = $rs ? 1 : 0;

            if(!$rs)
                $result['message'] = $article->message;
        } catch (ValidationException $e) {
            $result['message'] = '';
            \Log::info($e->getMessage(). $e->getFile() . $e->getLine());
        } catch (Exception $e) {
            \Log::info($e->getMessage(). $e->getFile() . $e->getLine());
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = [
            'status' => 0, 'message' => '删除失败!'
        ];
        if(!is_null($id)) {
            $id = intval($id);
        }
        if(!is_int($id) || $id <= 0) {

            $this->message = 'id参数错误,必须为大于0的整数';
        }else {

            try {
                $article = Article::find($id);
                if ($article) {
                    $rs = $article->delete();
                    if ($rs) {
                        $result['status'] = 1;
                        $result['message'] = '删除成功';
                        event(new ArticleDestroyed($article));
                    }
                }
            } catch (Exception $e) {
                \Log::info('delete faied :' , $e);
            }
        }

        return $result;
    }
}
