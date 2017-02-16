<html>
<body>
<h1>Hello</h1>

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
@if(count($errors))
    {{ dump($errors) }}
    {{ dump($errors->all()) }}
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

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
            </td>
        </tr>
    @endforeach
</table>


</body>
</html>