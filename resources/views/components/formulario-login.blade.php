<form class="login-card" method="POST" action="/login">
    @csrf

    <h1 class="login-title">Inici de Sessió</h1>

    @error('contrasenya')
        <small style="color: red; display: block;">{{ $message }}</small>
    @enderror

    <div class="field">
        <span class="field__icon field__icon--correu" aria-hidden="true"></span>
        <label class="field__label" for="email">Correu electrònic</label>
        <input class="field__input" type="email" id="email" name="correu" placeholder="Correu electrònic" autocomplete="email" required>
    </div>

    <div class="field">
        <span class="field__icon field__icon--clau" aria-hidden="true"></span>
        <label class="field__label" for="password">Contrasenya</label>
        <input class="field__input" type="password" id="password" name="contrasenya" placeholder="Contrasenya" autocomplete="current-password" required>
    </div>

    <div class="login-actions">
        <div class="login-actions__options">
            <a class="login-actions__link" href="/contrasenya/oblidada">Has oblidat la contrasenya?</a>
            <label class="remember">
                <input class="remember__check" type="checkbox" name="remember">
                <span>Recorda'm en el dispositiu</span>
            </label>
        </div>
        <button class="btn" type="submit">Enviar</button>
    </div>

    <p class="login-register"><a href="/registre">Registra't aquí</a></p>
</form>