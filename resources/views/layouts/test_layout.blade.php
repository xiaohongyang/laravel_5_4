<html>
<head>
    <title>
        App title - @yield('title')
    </title>
</head>
<body>
    @section('sidebar')
        This is the master sideBar
    @show

    <div class="container">
        @yield('content')
    </div>
</body>
</html>