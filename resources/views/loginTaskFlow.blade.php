@extends('layouts.logarse')

@section('title', 'Inicia sessió · TaskFlow')

@section('header-label', 'LOGIN')

@section('page-class', 'page--vidre')
@section('page-attrs', 'data-vidre-arrel')

@section('content')
    <img class="vidre-fons" src="{{ asset('img/background2.jpg') }}" alt="">

    <img class="login-logo" src="{{ asset('img/logo_blanc_taskflow.png') }}" alt="TaskFlow">

    @include('components.formulario-login')
@endsection

@section('scripts')
    @include('partials.js-vidre')
@endsection