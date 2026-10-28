@extends('layouts.dashboard')

@section('title', 'Afegir tasca · TaskFlow')

@section('header-title', 'tasques')

@php
    $rutaTreballadors = auth()->user()->rol_tipus === 'cap' ? route('cap.usuaris.index') : route('usuari.index');
@endphp

@section('header-nav')
    <a class="admin-header__link" href="{{ auth()->user()->rol_tipus === 'cap' ? route('dashboardcap.index') : route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENT</a>
    <a class="admin-header__link" href="{{ $rutaTreballadors }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
    
    @include('components.formulario-crea-tasca')

@endsection