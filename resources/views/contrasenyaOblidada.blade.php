@extends('layouts.logarse')

@section('title', 'Recuperar contrasenya · TaskFlow')

@section('content')
<div class="login-wrap">
    <img class="login-logo" src="{{ asset('img/svg/logo.svg') }}" alt="TaskFlow">

    <form class="login-card" method="POST" action="#">
        @csrf

        <h1 class="login-title">Recuperar contrasenya</h1>

        <p class="login-text">Introdueix el teu correu electrònic i t'enviarem les instruccions per recuperar la contrasenya.</p>

        <div class="field">
            <span class="field__icon field__icon--correu" aria-hidden="true"></span>
            <label class="field__label" for="correu">Correu electrònic</label>
            <input class="field__input" type="email" id="correu" name="correu" placeholder="Correu electrònic" autocomplete="email" required>
        </div>

        <div class="login-actions login-actions--sol">
            <button class="btn" type="submit">Enviar</button>
        </div>

        <p class="login-register"><a href="/login">Tornar al login</a></p>
    </form>
</div>
@endsection