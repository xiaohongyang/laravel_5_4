@extends('layouts.user_center')



@section('content')

    <div id="" class="text-right">
        <a href="{{ route('user-article-list') }}">go back</a>
    </div>

    <h3>create article</h3>

    @if(is_array($errors) )
        {{var_dump($errors)}}
    @endif

    @include('shared.errors')
    {!! form($form) !!}


    <!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain">
    这里写你的初始化内容
    </script>

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>

@endsection