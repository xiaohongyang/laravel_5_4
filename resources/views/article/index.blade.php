@extends('layouts.app')

@section('content')


@include("shared.errors")

    <div class="article-wrap" v-for="article in articleList"  >

        <div class="title">
            @{{article.title}}
        </div>
        <div class="desc"> @{{ article.description }}</div>
        <div class="about">
            <span class="tags">
                tags: <a href="#" v-for="tag in article.tags"> @{{ tag.name }} </a>
            </span>
            <span class="create-time">@{{ article.created_at }}</span>
            <span class="post-number">@{{ article.created_at }}</span>

        </div>
    </div>

    <div class="pagination" >

        <button class="btn btn-xs btn-success" v-on:click="goPrevPage"  v-if="pagination.prevPage" >上一页@{{pagination.prevPage}}@{{pagination.currentPage}}</button>
        <button class="btn btn-xs btn-success" v-on:click="goPrevPage"  v-if="!pagination.prevPage"  disabled>上一页</button>
        <button class="btn btn-xs btn-success" v-on:click="goNextPage" v-if="pagination.nextPage">下一页</button>
        <button class="btn btn-xs btn-success" v-on:click="goNextPage" v-if="!pagination.nextPage" disabled>下一页</button>
    </div>

@endsection


@section('scripts')
    {{ Html::script(mix('js/article/article.js')) }}
@endsection