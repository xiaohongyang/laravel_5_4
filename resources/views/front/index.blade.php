@extends('layouts.app')
<?php
        $a = "abc";
?>


@section('content')


    @{{ message | capitalize}}

    {{--<passport-clients></passport-clients>
    <passport-authorized-clients></passport-authorized-clients>
    <passport-personal-access-tokens></passport-personal-access-tokens>--}}

@endsection