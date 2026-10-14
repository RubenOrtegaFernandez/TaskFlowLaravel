<header class="admin-header">
    <a class="admin-header__logo" href="{{ url('/') }}" aria-label="TaskFlow">
        <img src="{{ asset('img/svg/logo.svg') }}" alt="TaskFlow">
    </a>

    <h1 class="admin-header__title">@yield('header-title', 'Dashboard')</h1>

    <nav class="admin-header__nav">
        @hasSection('header-nav')
            @yield('header-nav')
        @else
            <a class="admin-header__link" href="/tasques">Tasques</a>
            <a class="admin-header__link" href="/departaments">Departaments</a>
            <a class="admin-header__link" href="/treballadors">Treballadors</a>
            <a class="admin-header__link" href="/categories">Categories</a>
        @endif
    </nav>

    <img class="admin-header__avatar" src="{{ asset('img/default.png') }}" alt="Perfil">
</header>