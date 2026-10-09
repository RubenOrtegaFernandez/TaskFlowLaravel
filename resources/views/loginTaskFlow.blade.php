@extends('layouts.logarse')

@section('title', 'Inicia sessió · TaskFlow')

@section('header-label', 'LOGIN')

@section('content')
<div class="login-wrap">
    <img class="login-logo" src="{{ asset('img/svg/logo.svg') }}" alt="TaskFlow">

    @include('components.formulario-login')
</div>
@endsection
