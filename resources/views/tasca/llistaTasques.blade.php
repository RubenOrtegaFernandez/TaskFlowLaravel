@extends('layouts.dashboard')

@section('title', 'Tasques · TaskFlow')

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
    <a href="{{ route('users.export') }}" style="display: inline-block; background-color: #28a745; color: white;
        padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold; margin-bottom: 15px;">
        📊 Descarregar Excel
    </a>

    <a class="btn" href="{{ route('tasca.create') }}">Agregar</a>
    @include('components.taula-tasques')
</section>
@endsection
