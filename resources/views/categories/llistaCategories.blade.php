@extends('layouts.dashboard')

@section('title', 'Categories · TaskFlow')

@section('header-title', 'Categories')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">DEPARTAMENTS</a>
    <a class="admin-header__link" href="{{ route('categoria.index') }}">TREBALLADORS</a>
@endsection

@section('content')
<section class="admin-panel llista-tasques">
    <h2 class="admin-panel__title">CATEGORIES</h2>
    
    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif

    @include('components.taula-categories')
</section>
@endsection