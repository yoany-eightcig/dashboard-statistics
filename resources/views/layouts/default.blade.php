<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body class="">
    <div class="container-fluid mt-3">
        <div class="row">
            @include('includes.header')
        </div>
        <div id="main" class="row">
                @yield('content')
        </div>

        <footer class="row">
            @include('includes.footer')
        </footer>
    </div>
</body>
</html>