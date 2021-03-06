@extends('layouts.app')

@section('content')
{{ $name }}

{{ $currentDate }}
<br/>
Article's count: {{ $count }}

<form action="{{ route('article.store') }}" method="post">
    {{ csrf_field() }}
    {{ method_field("POST") }}
    <table>
        <tr>
            <td>title</td>
            <td><input type="text" name="title"/></td>
            <td>{{$errors->has('title') ? $errors->get('title')[0] : ''}}</td>
        </tr>
        <tr>
            <td>author</td>
            <td><input type="text" name="author"/></td>
            <td>{{$errors->has('author') ? $errors->get('author')[0] : ''}}</td>

        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="submit">
            </td>
        </tr>
    </table>
</form>

{{session('msg')}}
<br/>

@include("shared.errors")

<table>
    <tr>
        <td>title:</td>
        <td>author:</td>
        <td>created_at:</td>
    </tr>
    @foreach($articleList as $article)
        <tr>
            <td>
                {{$article->title}}
            </td>

            <td>
                {{$article->author}}
            </td>

            <td>
                {{ $article->created_at }}
                @dtime(time())
            </td>
        </tr>
    @endforeach
</table>

@endsection