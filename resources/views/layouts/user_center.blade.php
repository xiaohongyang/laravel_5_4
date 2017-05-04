<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}-'user_center'</title>

    <!-- Styles -->
    <link href="{{mix('/css/app.css')}}" rel="stylesheet">
    <link href="{{mix('/css/site.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'imgHost' => env('APP_IMG_URL')
        ]) !!}

    </script>

    @include('UEditor::head')

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="/">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }}
                                @can('isAdmin', 'App\User')
                                    管理员
                                @endcan
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="btn-group">
                    <ul>
                        <li>
                            <a href="{{ route('user-article-list') }}" class="">文章管理</a>
                        </li>
                        <li>
                            <a href="#" class="">评论管理</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div id="layout-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</div>


{{--<script src="{{mix('/js/app.js')}}"></script>--}}
<!--include socket.io.js-->
{{--<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>--}}

<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/site.js') }}"></script>


@yield('scripts')

</body>
</html>
