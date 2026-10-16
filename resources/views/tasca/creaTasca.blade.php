@extends('layouts.dashboard')

@section('title', 'Afegir tasca · TaskFlow')

@section('header-title', 'tasques')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">Dashboard</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">Departaments</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">Treballadors</a>
    <a class="admin-header__link" href="{{ route('categoria.index') }}">Categories</a>
@endsection

@section('content')

    @include('components.formulario-crea-tasca')

@endsection