
<form class="login-card" data-vidre method="POST" action="{{ route('contrasenya.actualitzar', ['token' => request()->route('token'), 'correu' => request('correu')]) }}">
    @csrf

    <h1 class="login-title">Nova contrasenya</h1>

    <p class="login-text">
        Introdueix la teva nova contrasenya.
    </p>

    <input type="hidden" name="correu" value="{{ request('correu') }}">

    <div class="field">
        <svg class="field__icon field__icon--clau" aria-hidden="true">
            <use xlink:href="#icon-key"></use>
        </svg>

        <label class="field__label" for="contrasenya">Nova contrasenya</label>
        <input class="field__input" type="password" id="contrasenya" name="contrasenya" placeholder="Nova contrasenya" autocomplete="new-password" required>
    </div>

    <div class="field">
        <svg class="field__icon field__icon--clau" aria-hidden="true">
            <use xlink:href="#icon-key"></use>
        </svg>

        <label class="field__label" for="contrasenya_confirmation">Repeteix la contrasenya</label>
        <input class="field__input" type="password" id="contrasenya_confirmation" name="contrasenya_confirmation" placeholder="Repeteix la contrasenya" autocomplete="new-password" required>
    </div>

    @if ($errors->any())
        <p style="color: #ff5555; text-align: center;">
            {{ $errors->first() }}
        </p>
    @endif

    @if (session('status'))
        <p style="color: #55ff55; text-align: center;">
            {{ session('status') }}
        </p>
    @endif

    <div class="login-actions login-actions--sol">
        <button class="btn" type="submit">Canviar contrasenya</button>
    </div>

    <p class="login-register">
        <a href="{{ route('login') }}">Tornar al login</a>
    </p>
</form>
