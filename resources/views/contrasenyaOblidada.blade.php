
@extends('layouts.logarse')

@section('title', 'Recuperar contrasenya · TaskFlow')

@section('header-label', 'RECUPERAR CONTRASENYA')

@section('page-class', 'page--vidre')

@section('page-attrs', 'data-vidre-arrel')

@section('content')
    <img class="vidre-fons" src="{{ asset('img/background2.jpg') }}" alt="">

    <img class="login-logo" src="{{ asset('img/logo_blanc_taskflow.png') }}" alt="TaskFlow">

    <form class="login-card" data-vidre method="POST" action="#">
        @csrf

        <h1 class="login-title">Recuperar contrasenya</h1>

        <p class="login-text">
            Introdueix el teu correu electrònic i t'enviarem les instruccions per recuperar la contrasenya.
        </p>

        <div class="field">
            <svg class="field__icon field__icon--correu" aria-hidden="true">
                <use xlink:href="#icon-email"></use>
            </svg>

            <label class="field__label" for="email">Correu electrònic</label>

            <input class="field__input" type="email" id="email" name="correu" placeholder="Correu electrònic" autocomplete="email" required>
        </div>

        <div class="login-actions login-actions--sol">
            <button class="btn" type="submit">Enviar</button>
        </div>

        <p class="login-register">
            <a href="/login">Tornar al login</a>
        </p>
    </form>
@endsection

@section('scripts')
    @include('partials.js-vidre')
@endsection
