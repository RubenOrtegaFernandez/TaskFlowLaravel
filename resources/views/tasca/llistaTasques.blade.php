@extends('layouts.dashboard')

@section('title', 'Tasques · TaskFlow')

@section('header-title', 'Tasques')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENT</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="admin-panel llista-tasques">
    <h2 class="admin-panel__title">LLISTAT DE TASQUES</h2>
    
    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif

    <a class="btn" href="{{ route('tasca.create') }}">Agregar</a>
    @include('components.taula-tasques')
</section>
@endsection
