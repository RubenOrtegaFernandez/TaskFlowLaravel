<form class="login-card" data-vidre id="form-login" method="POST" action="/login" novalidate>
    @csrf

    <h1 class="login-title">Inici de Sessió</h1>

    <div class="field">
        <svg class="field__icon field__icon--correu" aria-hidden="true">
            <use xlink:href="#icon-email"></use>
        </svg>

        <label class="field__label" for="email">Correu electrònic</label>
        <input class="field__input" type="email" id="email" name="correu" placeholder="Correu electrònic" value="{{ old('correu') }}" autocomplete="email">
    </div>

    <div class="field">
        <svg class="field__icon field__icon--clau" aria-hidden="true">
            <use xlink:href="#icon-key"></use>
        </svg>

        <label class="field__label" for="password">Contrasenya</label>
        <input class="field__input" type="password" id="password" name="contrasenya" placeholder="Contrasenya" autocomplete="current-password">
        @include('components.boto-ull-contrasenya', ['id' => 'password', 'class' => 'field__password-toggle'])
    </div>

    <div class="login-actions">
        <div class="login-actions__options">
            <a class="login-actions__link" href="/contrasenya/oblidada">
                Has oblidat la contrasenya?
            </a>

            <label class="remember">
                <input class="remember__check" type="checkbox" name="remember">
                <span>Recorda'm en el dispositiu</span>
            </label>
        </div>

        <button class="btn" type="submit">Enviar</button>
    </div>

    <p class="login-register">
        <a href="/registre">Registra't aquí</a>
    </p>

    {{-- Missatges d'error per JavaScript --}}
    <p id="error-login" style="color: #ff5555; display: block; margin-bottom: 12px; font-weight: bold; text-align: center;" hidden></p>

    {{-- Missatges d'errors de Laravel --}}
    @if (session('error'))
        <p style="color: #ff5555; display: block; margin-bottom: 12px; font-weight: bold; text-align: center;">
            {{ session('error') }}
        </p>
    @endif

    @if (session('status'))
        <p style="color: #55ff55; display: block; margin-bottom: 12px; font-weight: bold; text-align: center;">
            {{ session('status') }}
        </p>
    @endif

    @if ($errors->any())
        <p style="color: #ff5555; display: block; margin-bottom: 12px; font-weight: bold; text-align: center;">
            {{ $errors->first() }}
        </p>
    @endif
</form>
