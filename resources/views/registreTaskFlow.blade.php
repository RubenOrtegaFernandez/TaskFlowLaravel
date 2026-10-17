
@extends('layouts.logarse')

@section('title', 'Registre · TaskFlow')

@section('header-label', 'REGISTRE')

@section('page-class', 'page--vidre')

@section('page-attrs', 'data-vidre-arrel')

@section('content')
    <img class="vidre-fons" src="{{ asset('img/background2.jpg') }}" alt="">

    <img class="login-logo" src="{{ asset('img/logo_blanc_taskflow.png') }}" alt="TaskFlow">

    @include('components.formulario-registro')

    @if (session('error'))
        <p class="login-register">{{ session('error') }}</p>
    @endif
@endsection

@section('scripts')
    @include('partials.js-vidre')
@endsection
