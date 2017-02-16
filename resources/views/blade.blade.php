@extends('layouts.test_layout')

@section('title', "JackXiao's title")

@section('sidebar')

    @parent

    <p> This is append to the parent sideBar</p>
@endsection


@section('content')
    <p> This is my body content.</p>
@endsection