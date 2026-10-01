@extends('layouts.guest')

@section('title', 'Inicia sessió · TaskFlow')

@section('content')
<div class="login-wrap">

    <div class="login-title">
        <h1 class="login-title__text">Inici de sessió</h1>
    </div>

    <form class="login-card" method="POST" action="#">
        @csrf

        <div class="deco deco--top" aria-hidden="true">
            <div class="deco__row"><span class="deco__bar deco__bar--68"></span><span class="deco__bar deco__bar--239"></span><span class="deco__bar deco__bar--170"></span></div>
            <div class="deco__row"><span class="deco__bar deco__bar--196"></span><span class="deco__bar deco__bar--62"></span><span class="deco__bar deco__bar--220"></span></div>
            <div class="deco__row"><span class="deco__bar deco__bar--181"></span><span class="deco__bar deco__bar--314"></span></div>
        </div>

        <div class="field">
            <label class="field__label" for="email">Correu electrònic</label>
            <input class="field__input field__input--right" type="email" id="email" name="email" placeholder="Correu electrònic" autocomplete="email" required>
            <span class="field__icon field__icon--correu" aria-hidden="true"></span>
        </div>

        <div class="field">
            <span class="field__icon field__icon--clau" aria-hidden="true"></span>
            <label class="field__label" for="password">Contrasenya</label>
            <input class="field__input" type="password" id="password" name="password" placeholder="Contrasenya" autocomplete="current-password" required>
        </div>

        <div class="login-actions">
            <div class="login-actions__options">
                <a class="login-actions__link" href="#">Has oblidat la contrasenya?</a>
                <label class="remember">
                    <input class="remember__check" type="checkbox" name="remember">
                    <span>Recorda'm en el dispositiu</span>
                </label>
            </div>
            <button class="btn" type="submit">Enviar</button>
        </div>

        <div class="deco deco--bottom" aria-hidden="true">
            <div class="deco__row"><span class="deco__bar deco__bar--314"></span><span class="deco__bar deco__bar--181"></span></div>
            <div class="deco__row"><span class="deco__bar deco__bar--220"></span><span class="deco__bar deco__bar--62"></span><span class="deco__bar deco__bar--196"></span></div>
            <div class="deco__row"><span class="deco__bar deco__bar--170"></span><span class="deco__bar deco__bar--239"></span><span class="deco__bar deco__bar--68"></span></div>
        </div>
    </form>

    <p class="login-register">No tens compte? <a href="#">Registra't</a></p>

</div>
@endsection