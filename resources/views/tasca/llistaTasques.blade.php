@extends('layouts.dashboard')

@section('title', 'Tasques')

@section('header-title', 'Tasques')

@php
    $rutaDashboard = auth()->user()->rol_tipus === 'cap' ? route('dashboardcap.index') : route('dashboardadmin.index');
    $rutaTreballadors = auth()->user()->rol_tipus === 'cap' ? route('cap.usuaris.index') : route('usuari.index');
@endphp

@section('header-nav')
    <a class="admin-header__link" href="{{ $rutaDashboard }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENT</a>
    <a class="admin-header__link" href="{{ $rutaTreballadors }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="admin-panel llista-tasques">
    <h2 class="admin-panel__title">LLISTAT DE TASQUES</h2>
    
    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif
    <a class="btn btn--exportar" href="{{ route('tasques.export') }}">
        📊 Descarregar Excel
    </a>

    <a class="btn" href="{{ route('tasca.create', ['origen' => 'tasques']) }}">Agregar</a>
    @include('components.taula-tasques')
</section>
@endsection
