@extends('layouts.dashboard')

@section('title', 'Treballadors · TaskFlow')

@section('header-title', 'Treballadors')

@section('header-nav')
    <a class="admin-header__link" href="{{ auth()->user()->rol_tipus === 'cap' ? route('dashboardcap.index') : route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENTS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="admin-panel llista-tasques usuaris-llista">
    <h2 class="admin-panel__title">TREBALLADORS</h2>

    @if (session('status'))
        <p class="admin-panel__description" role="status">{{ session('status') }}</p>
    @endif

    @if (session('error'))
        <p class="admin-panel__description" role="alert">{{ session('error') }}</p>
    @endif

    @if (auth()->user()->rol_tipus === 'cap')
        <p class="admin-panel__description">Usuaris del departament {{ auth()->user()->departament?->nom }}.</p>
    @endif

    @include('components.taula-treballadors')
</section>
@endsection
