<form class="login-card" method="POST" action="/registre">
    @csrf

    <h1 class="login-title">Crear compte</h1>

    @error('contrasenya')
        <small style="color: red; display: block;">{{ $message }}</small>
    @enderror

    <div class="field">
        <span class="field__icon field__icon--nom" aria-hidden="true"></span>
        <label class="field__label" for="nom_usu">Nom</label>
        <input class="field__input" type="text" id="nom_usu" name="nom_usu" placeholder="Nom" autocomplete="name" required>
    </div>

    <div class="field">
        <span class="field__icon field__icon--correu" aria-hidden="true"></span>
        <label class="field__label" for="email">Correu electrònic</label>
        <input class="field__input" type="email" id="email" name="correu" placeholder="Correu electrònic" autocomplete="email" required>
    </div>

    <div class="field">
        <span class="field__icon field__icon--clau" aria-hidden="true"></span>
        <label class="field__label" for="password">Contrasenya</label>
        <input class="field__input" type="password" id="password" name="contrasenya" placeholder="Contrasenya" autocomplete="new-password" required>
    </div>

    <div class="login-actions login-actions--sol">
        <button class="btn" type="submit">Enviar</button>
    </div>

    <p class="login-register"><a href="/login">Tornar al login</a></p>
</form>