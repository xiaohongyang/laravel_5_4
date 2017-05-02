@extends('layouts.user_center')

@section('content')

    @include('shared.message')


    <div id="list">

        <div id="" class="text-right">
            <a href="{{ route('user-article-create') }}">create article</a>
        </div>

        <table class="table table-bordered table-striped">

            <tr>
                <td><input type="checkbox" class="checlAll" v-on:click="checkOrCancelAll()"  ></td>
                <td>title</td>
                <td>author</td>
                <td>desc</td>
                <td>update_date</td>
                <td>opration</td>
            </tr>


            @foreach( $articleList as $article)
                <tr>
                    <td><input class="selectArticle" type="checkbox" value="{{ $article->id }}"></td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->author}}</td>
                    <td></td>
                    <td>{{ date('Y-m-d H:i', $article->updated_at->getTimestamp()) }}</td>
                    <td>
                        <div class="btn-group">

                            <a href="{{ route('user-article-create', ['id'=>$article->id]) }}" class="btn btn-primary btn-xs ">编辑</a>
                            <a href="{{ route('user-article-del', ['id'=>$article->id]) }}" class="btn btn-primary btn-xs ">删除</a>
                            <a href="{{ route('user-article-discuss-list', ['id'=>$article->id]) }}" class="btn btn-primary btn-xs ">评论管理</a>
                        </div>
                    </td>
                </tr>
            @endforeach

        </table>

        {{ $articleList->links() }}
    </div>

@endsection

@section('scripts')
    {{ Html::script(mix('js/article/article.js')) }}
@endsection