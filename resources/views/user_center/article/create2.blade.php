@extends('layouts.user_center')



@section('content')

    <div id="" class="text-right">
        <a href="{{ route('user-article-list') }}">go back</a>
    </div>

    <h3>create article</h3>

    <center-article-create></center-article-create>

    33
@endsection


@section('scripts')
    {{--{{ Html::script(mix('js/article/article.js')) }}--}}
@endsection