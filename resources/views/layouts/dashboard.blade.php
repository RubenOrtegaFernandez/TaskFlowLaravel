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
</head>
<body class="admin-body">
    <div class="admin-shell">
        <header class="admin-header">
            <a class="admin-header__logo" href="{{ url('/') }}" aria-label="TaskFlow">
                <img src="{{ asset('img/svg/logo.svg') }}" alt="TaskFlow">
            </a>

            <h1 class="admin-header__title">Dashboard</h1>

            <img class="admin-header__avatar" src="{{ asset('img/default.png') }}" alt="Perfil">
        </header>

        <main class="admin-main">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>