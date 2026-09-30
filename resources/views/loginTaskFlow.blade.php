@extends('layouts.guest')

@section('title', 'Inicia sessió · TaskFlow')

@section('content')
<div class="login-wrap">
    <form class="login-card" method="POST" action="#">
        @csrf
        <h2 class="login-card__title">Benvingut de nou</h2>
        <p class="login-card__sub">// Inicia sessió al teu compte</p>

        <div class="field">
            <label class="field__label" for="email">
                <span>[ Correu electrònic ]</span>
            </label>
            <div class="field__box">
                <input class="field__input" type="email" id="email" name="email" placeholder="Correu electrònic" required>
                <!--<svg class="field__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z"/>
                </svg>-->
            </div>
        </div>

        <div class="field">
            <label class="field__label" for="password"><span>[ Contrasenya ]</span></label>
            <div class="field__box">
                <input class="field__input" type="password" id="password" name="password" placeholder="Contrasenya" required>
            </div>
        </div>

        <div class="login-options">
            <label class="login-options__remember">
                <input type="checkbox" name="remember" checked> Recorda'm
            </label>
            <a href="#">Has oblidat la contrasenya?</a>
        </div>

        <button type="submit" class="btn btn--primary">Iniciar sessió</button>

        <div class="divider">O</div>

        <button type="button" class="btn btn--outline">Continuar amb Google</button>

        <p class="login-card__register">No tens compte? <a href="#">Registra't</a></p>
    </form>
</div>
@endsection