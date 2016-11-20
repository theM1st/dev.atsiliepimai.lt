<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    @include('styles')
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>
<body>
    <div id="app">
        @if (Auth::check() && Auth::user()->admin)
            @include('admin.navbar')
        @endif

        @include('header')

        <main class="main">
            @include('alert')
            @yield('content')
        </main>
    </div>
    @include('scripts')
</body>
</html>
