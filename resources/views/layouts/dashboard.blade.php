<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard · TaskFlow')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;700;800&family=Martian+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @vite(['resources/js/popups.js', 'resources/js/registre.js'])
</head>
<body class="admin-body">
    @include('partials.icons')

    <div class="admin-shell">
        <img
            class="vidre-fons"
            src="{{ asset('img/background2.jpg') }}"
            alt=""
            aria-hidden="true"
        >

        @include('components.encapcalament-dashboard')

        <main class="admin-main">
            <img class="vidre-fons" src="{{ asset('img/background2.jpg') }}" alt="" aria-hidden="true">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/registre.js') }}"></script>
    @include('partials.js-vidre')
</body>
</html>
