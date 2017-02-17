@push('scripts', '<script src="/example.js"></script>');
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

    @stack('scripts')
</body>
</html>