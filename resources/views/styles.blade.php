<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/icheck/skins/square/green.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@if (Auth::check() && Auth::user()->admin)
    <link href="/css/admin/base.css" rel="stylesheet">
@endif
@yield('styles')