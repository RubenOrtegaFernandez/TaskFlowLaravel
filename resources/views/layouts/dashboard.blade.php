<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TaskFlow')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600;700&family=Syne:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&family=Martian+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <header class="header">
        <a href="{{ url('/') }}" class="header__logo" aria-label="TaskFlow">
            <img class="header__logo-img" src="{{ asset('img/logo_text.svg') }}" alt="TaskFlow">
        </a>
    </header>

    <main class="page">
        @yield('content')
    </main>

    <footer class="footer">
        <span></span>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
