@extends('layouts.dashboard')

@section('title', 'Afegir tasca · TaskFlow')

@section('header-title', 'tasques')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENT</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categoria.index') }}">CATEGORIES</a>
@endsection

@section('content')
    
    @include('components.formulario-crea-tasca')

@endsection