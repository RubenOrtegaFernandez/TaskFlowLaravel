@extends('layouts.logarse')

@section('title', 'Recuperació de contrasenya · TaskFlow')

@section('header-label', 'RECUPERAR CONTRASENYA')

@section('page-class', 'page--vidre')

@section('page-attrs', 'data-vidre-arrel')

@section('content')
    <img class="vidre-fons" src="{{ asset('img/background2.jpg') }}" alt="">

    <img class="login-logo" src="{{ asset('img/logo_blanc_taskflow.png') }}" alt="TaskFlow">

    <div class="login-card mail-recovery-card" data-vidre>
        <h1 class="login-title mail-recovery-title">Recuperació de contrasenya</h1>

        <p class="login-text mail-recovery-text">
            Hola,
        </p>

        <p class="login-text mail-recovery-text">
            Hem rebut la teva sol·licitud per recuperar la contrasenya.
        </p>

        <p class="login-text mail-recovery-text">
            Per continuar, clica al següent enllaç:
        </p>

        <div class="mail-recovery-actions">
            <a href="{{ $enllac }}" class="btn btn--mail-recovery">
                Restablir contrasenya
            </a>
        </div>

        <p class="login-text mail-recovery-text">
            Si no has demanat aquest canvi, pots ignorar aquest correu.
        </p>

        <p class="login-text mail-recovery-signature">
            Gràcies,<br>
            TaskFlow
        </p>
    </div>
@endsection
