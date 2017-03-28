<?php
use Carbon\Carbon;use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
?>

@extends('layouts.app')

@section('content')

    <br/>
    <?=url()->full()?>

    <br/>
    <?=url()->current()?>

@endsection
