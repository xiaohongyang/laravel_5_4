@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <nav>
                        <ul>
                            <li><a href="{{route('article.index')}}">文章管理</a></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </nav>

                    <?php
                    use Carbon\Carbon;if(!cache('uid4Hee')){
                            dump("uid4Hee not exist!");
                            cache(['uid4Hee'=>11], Carbon::now()->addSeconds(3));
                        } else {
                            dump("uid exist!");
                        }
                    ?>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
