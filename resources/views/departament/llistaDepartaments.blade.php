@extends('layouts.dashboard')

@section('title', 'Departaments · TaskFlow')

@section('header-title', 'Departaments')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="admin-panel llista-tasques departaments-llista">
    <h2 class="admin-panel__title">DEPARTAMENTS</h2>
    
    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif

    @if (auth()->user()->rol_tipus === 'admin')
        <a class="btn" href="{{ route('departament.create') }}">Agregar departamento</a>
    @endif

    @include('components.taula-departaments')
</section>
@endsection
