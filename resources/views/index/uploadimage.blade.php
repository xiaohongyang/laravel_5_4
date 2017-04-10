@extends('layouts.app')



@section('content')

    {{ Form::open([
        'url' => 'douploadimage',
        'method' => 'post',
        'files' => true
    ]) }}

    {{ Form::hidden('directory', env('ARTICLE_THUMB_FILE_PATH')) }}

    {{ Form::label('thumb', '上传图片') }}
    {{ Form::file('thumb') }}

    {{ Form::submit('提交') }}

    {{ Form::close() }}

@endsection