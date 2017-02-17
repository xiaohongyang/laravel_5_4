@extends('layouts.test_layout')
@php
    {{-- here you can write php code --}}
@endphp

@section('title', "JackXiao's title")

@section('sidebar')

    @parent

    <p> This is append to the parent sideBar</p>
@endsection


@section('content')
    <p> This is my body content.</p>

    @component('alert', ['title' => 'testvvv'])
        <strong>Whoops!</strong> Something went wrong!
    @endcomponent

    @component('alert')
        @slot('title')
            <B>slot title</B>
        @endslot
        this 's component slot body content <br/>
        {{ "<div><em>escape content</em></div>"  }} <br/>
        {!! "<div><em>unescape content</em></div>"  !!}

        @verbatim
            //使用verbatim标签，防止解析js中的{{}}字符串或变量
            <div class="container">
                hi {{ name }}
            </div>
        @endverbatim


        @foreach(['a','b','c','d','e'] as $item)
            @if($loop->first)
                <b>this is first:</b>
            @endif

            @if($loop->last)
                <b>this is last:</b>
            @endif
            {{$loop->index}}=>{{$item}} <br/>
            {{-- comment will not be present in the render HTML --}}
            <!-- comment will be present in render HTML -->

        @endforeach

        @each('view.name', [1,2,3,4,5,6], 'item')

    @endcomponent



@endsection




