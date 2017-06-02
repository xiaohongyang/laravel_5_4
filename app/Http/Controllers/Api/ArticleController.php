<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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

        dd('create:');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $result = [
            'status' => 0,
            'message' => []
        ];

        try {

            $validator = \Validator::make($request->all(), [
                'title' => ['required'],
            ]);
            if($validator->fails()){
                $result['message'] = $validator->messages()->getMessageBag();
            } else {
                $article = new Article();
                $request->merge(['user_id' => \Auth::guard('api')->id()]);
                $rs = $article->createOrEdit($request);
                $result['status'] = $rs ? 1 : 0;
            }
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
    public function show($id)
    {
        //
        $result = ['status' => 0, 'message'=>'文章不存在'];
        $article = Article::findOrFail($id);
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
    public function edit($id)
    {
        //
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
        //
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
    }
}
