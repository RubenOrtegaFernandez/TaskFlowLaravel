@extends('layouts.logarse')

@section('title', 'Inicia sessió · TaskFlow')

@section('content')
<div class="login-wrap">

    <div class="login-title">
        <h1 class="login-title__text">Inici de sessió</h1>
    </div>

    @include('components.formulario-login')

    <p class="login-register">No tens compte? <a href="/registre">Registra't</a></p>

</div>
@endsection