@extends('layouts.test_layout')


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
        this 's component slot body content
    @endcomponent
@endsection


