@extends('layouts.dashboard')

@section('title', 'Tasques · TaskFlow')

@section('header-title', 'Tasques')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENT</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categoria.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="admin-panel llista-tasques">
    <h2 class="admin-panel__title">LLISTAT DE TASQUES</h2>
    
    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif

    @include('components.taula-tasques')
</section>
@endsection