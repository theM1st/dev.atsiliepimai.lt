<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="YOt8zkoH1_w5AanKz7tPByFCpN5Jg1NrA0xsaMwLMZY">

    <title>@yield('title') - {{ config('app.name') }}</title>

    <meta name="description" content="@yield('description')">

    @include('styles')
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-91090300-2', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<body>
    <div id="app">
        @if (Auth::check() && Auth::user()->admin)
            @include('admin.navbar')
        @endif

        @include('header')

        <main class="main{{ (Request::segment(1) == 'admin' ? ' admin-container' : '') }}">
            <div class="container hidden-xs">
                @yield('breadcrumbs')
            </div>
            @include('alert')
            @yield('content')
        </main>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        @include('pages.menu.footer')
                    </div>
                    <div class="col-md-5 clearfix">
                        <div class="copyright">
                            Copyright &copy; {{ date('Y') }}<br>All Rights Reserved. <br>
                            User Agreement, Privacy, Cookies.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @include('scripts')
</body>
</html>
