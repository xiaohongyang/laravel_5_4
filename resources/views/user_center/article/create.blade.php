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


@endsection