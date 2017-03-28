@extends('layouts.user_center')

@section('content')

    <div id="" class="text-right">
        <a href="{{ route('article-create') }}">create article</a>
    </div>

    <table class="table table-bordered table-striped">

        <tr>
            <td>title</td>
            <td>author</td>
            <td>desc</td>
            <td>update_date</td>
            <td>opration</td>
        </tr>

        @foreach( $articleList as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->authorUser->name}}</td>
                <td></td>
                <td>{{ date('Y-m-d H:i', $article->updated_at->getTimestamp()) }}</td>
                <td>
                    <div class="btn-group">

                        <a href="{{ route('article-create', ['id'=>$article->id]) }}" class="btn btn-primary btn-xs ">edit</a>
                        <a href="{{ route('article-del', ['id'=>$article->id]) }}" class="btn btn-primary btn-xs ">del</a>
                    </div>
                </td>
            </tr>
        @endforeach

    </table>

    {{ $articleList->links() }}

@endsection