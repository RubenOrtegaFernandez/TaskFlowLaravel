
<form id="form-regisr" class="login-card" method="POST" action="/registre" novalidate>
    @csrf

    <h1 class="login-title">Crear compte</h1>

    @error('contrasenya')
        <small style="color: red; display: block;">{{ $message }}</small>
    @enderror

    <div class="field">
        <svg class="field__icon field__icon--nom" aria-hidden="true">
            <use xlink:href="#icon-name"></use>
        </svg>

        <label class="field__label" for="nom_usu">Nom</label>
        <input class="field__input" type="text" id="nom_usu" name="nom_usu" placeholder="Nom" autocomplete="name">
    </div>

    <div class="field">
        <svg class="field__icon field__icon--correu" aria-hidden="true">
            <use xlink:href="#icon-email"></use>
        </svg>

        <label class="field__label" for="email">Correu electrònic</label>
        <input class="field__input" type="email" id="email" name="correu" placeholder="Correu electrònic" autocomplete="email">
    </div>

    <div class="field">
        <svg class="field__icon field__icon--clau" aria-hidden="true">
            <use xlink:href="#icon-key"></use>
        </svg>

        <label class="field__label" for="password">Contrasenya</label>
        <input class="field__input" type="password" id="password" name="contrasenya" placeholder="Contrasenya" autocomplete="new-password">
    </div>

    <div class="login-actions enviar-altern">
        <span>Ja tens compte?</span>

        <a class="login-actions__link" href="/login">
            Inicia sessió aquí
        </a>

        <button class="btn" type="submit">Enviar</button>
    </div>

    <p class="login-register">
        <a href="/login">Tornar al login</a>
    </p>
</form>
