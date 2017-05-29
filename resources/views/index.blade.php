<?php
use Carbon\Carbon;use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
?>

@extends('layouts.app')

@section('content')

    <div id="layout-content">
        <example></example>
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>



        clientId : <input type="text" v-model="clientId" /> <br/>
        clientName : <input type="text" v-model="clientName" /> <br/>
        clientRedirect : <input type="text" v-model="clientRedirect" /> <br/>

        <textarea v-modelo="clientResponse"></textarea>

        <button v-on:click="create">create</button>
        <button v-on:click="update">update</button>
        <button v-on:click="deletes">delete</button>
        <button v-on:click="getUser">getUser</button>
    </div>

@endsection

@section('scripts')
   <script src="{{ mix('js/index/index.js') }}"></script>
@endsection