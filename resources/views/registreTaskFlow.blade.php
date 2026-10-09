@extends('layouts.logarse')

@section('title', 'Registre · TaskFlow')

@section('header-label', 'REGISTRE')

@section('content')
<div class="login-wrap">
    <img class="login-logo" src="{{ asset('img/logo_text.svg') }}" alt="TaskFlow">

    @include('components.formulario-registro')

    @if (session('error'))
        <p class="login-register">{{ session('error') }}</p>
    @endif
</div>
@endsection
