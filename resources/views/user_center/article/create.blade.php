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

    <a href="javascript:void(0)" class="btn btn-xs btn-primary" v-on:click="revertString"> </a>

   {{-- @include('user_center.article.upload')--}}



@endsection

@section('scripts')
    {{--{{  Html::script(mix('js/article/article.js')) }}--}}


    <script type="text/javascript">

        $('body').on('click', '.ajax_upload_img', function(){

            $(this).prev().prev('.ajax_upload').trigger('click');
        })
        $('input.ajax_upload').change(function(){

            var t = $(this)
            var file = t.get(0).files[0];
            var url = t.attr('data-url');
            var directory = t.attr('data-directory');

            var formData = new FormData();;
            formData.append('thumb' , file);
            formData.append('_token', window.Laravel.csrfToken);
            formData.append('directory', directory);
            var data = formData;
            $.ajax({
                beforeSend : function(xhy){
                    xhy.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImYwODFmMjVkZWU0ZjgzYjhiZTdlNmRlNjY3MjNjM2UyYWNmYjY2ZTlmNjRmMzA3NTA1ZjVlOWMyYTg3NWVmZDFiNGRlYzJlNDZhZWI1ODUyIn0.eyJhdWQiOiI1IiwianRpIjoiZjA4MWYyNWRlZTRmODNiOGJlN2U2ZGU2NjcyM2MzZTJhY2ZiNjZlOWY2NGYzMDc1MDVmNWU5YzJhODc1ZWZkMWI0ZGVjMmU0NmFlYjU4NTIiLCJpYXQiOjE0OTY3OTYyMTAsIm5iZiI6MTQ5Njc5NjIxMCwiZXhwIjoxNDk3MzE0NjEwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.3OxI5f9DwdinVzBIV9XvF7jDIl50gFSVplnYnZRtAWpyP-cRabPt-0-cZmYpGBjl3P__y2v69bRXgaKsHv6lo3MkaCzSW6W_oq0EQjRIKT-OREXaBIPKRxu_vaneKIBaXU444NQnfYEqHTZ09h__wpL3jRsH3DsccidRex6o9tZ2m1nXkTEUnEjAQUkoiPGqh0M3JLTjLOHagWuWVkB5vweogoG1sFvf6CyEmUPjYY9qx31yYsXrlHxZGw7tpXLOypF-Ib-GCtpj8hIexPOVr9xFmnsXQVfOEkb9PYD13hcfrZKjvKGIh5h3jrtAC18i7jfSDBaOFjmGUl7ekxFx7sY573_26vopsiD-aAln2Gzoh8-d1vZR8_LdyvvwELiiBbpsC6vzSpO8g0QVEqTeMmJ0791tkLoPuLxpJ-rq68OgJURvLxrNvuTlZwV6xAfqi61K9EyL_pHf83k89kNRgYRz_2AdonU4i9w7p6w5qz0AjDFrgmvX-DjkeqT0KV8dbcZW9CO75W4jrkyGu40G0THJmUhPEryenRro4Kh_xDGqPLqwReP8Uzuh8XRX_hNd42JM41iU1A8APqvwQkKIUrIXwVTzYoB8qS7FWePqif3Lvdty9jKIp5QHm7-0Gja5zsJnL1zC5xm3Bgc2Yp5LjybfmJoFihcrfCGIj08qq98')
                },
                url : url,
                data : formData,
                type : 'post',
                success : function (json) {
                    console.log(json)
                    if (json.result == true) {
                        t.next('input[type=hidden]').val(json.file)
                        t.next().next('.ajax_upload_img').attr('src', getImageUrl(json.file))
                    } else {
                        console.log(json);
                        try {
                            alert (json.errors[t.next('input[type=hidden]').attr('name')][0] )
                        }catch (e){}
                    }
                },
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
            })
        })
    </script>

@endsection