<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TaskFlow')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600;700&family=Syne:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <header class="header">
        <a href="{{ url('/') }}" class="header__logo" aria-label="TaskFlow">
            <svg width="26" height="26" viewBox="0 0 26 26" aria-hidden="true">
                <rect x="1" y="1" width="24" height="24" rx="4" fill="#00b8ff" stroke="#041c24" stroke-width="2"/>
                <path d="M7 14l4 4 8-9" fill="none" stroke="#041c24" stroke-width="3" stroke-linecap="square"/>
            </svg>
            <span class="header__logo-text">TaskFlow</span>
        </a>
        <div class="header__tags">
            <span class="tag tag--light">DISSENY DE LA INTERFÍCIE: Completat fa 2 minuts</span>
            <span class="tag tag--cyan">INCIDÈNCIA #402: Resolt per Sarah</span>
        </div>
    </header>

    <section class="hero">
        <h1 class="hero__title">Gestiona tus tareas<br>con eficiencia</h1>
        <p class="hero__subtitle">Coordina el teu equip, resol incidències a l'instant i escala la productivitat des d'un sol lloc.</p>
    </section>

    <main class="page">
        @yield('content')
    </main>

    <footer class="footer">
        <span>© 2026 TaskFlow Inc. Tots els drets reservats.</span>
        <span>// Badalona, Ins La Pineda</span>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>