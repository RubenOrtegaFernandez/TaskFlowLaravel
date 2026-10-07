<form class="login-card" method="POST" action="/registre">
    @csrf

    @error('contrasenya')
        <small style="color: red; display: block; margin-top: 5px;">
            {{ $message }}
        </small>
    @enderror
    
    <div class="field">
        <span class="field__icon field__icon--nom" aria-hidden="true"></span>
        <label class="field__label" for="nom_usu">Nom</label>
        <input class="field__input" type="text" id="nom_usu" name="nom_usu" placeholder="Nom" autocomplete="nom" required>
    </div>

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
        <button class="btn" type="submit">Enviar</button>
    </div>

    <span class="field__icon field__icon--tornar" aria-hidden="true"><a href="/login">Tornar al login</a></span>
</form>