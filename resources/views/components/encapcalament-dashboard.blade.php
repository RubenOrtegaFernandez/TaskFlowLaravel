<header class="admin-header" data-vidre>
    <a class="admin-header__logo" href="{{ asset('/login') }}" aria-label="TaskFlow">
        <img class="login-logo" src="{{ asset('img/logo_blanc_taskflow.png') }}" alt="TaskFlow">
    </a>

    <h1 class="admin-header__title">@yield('header-title', 'Dashboard')</h1>

    <nav class="admin-header__nav">
        @hasSection('header-nav')
            @yield('header-nav')
        @elseif (! View::hasSection('sense-nav'))
            <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
            <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENTS</a>
            <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
            <a class="admin-header__link" href="{{ route('categoria.index') }}">CATEGORÍES</a>
        @endif
    </nav>

    <img class="admin-header__avatar" src="{{ asset('img/default.png') }}" alt="Perfil">
</header>