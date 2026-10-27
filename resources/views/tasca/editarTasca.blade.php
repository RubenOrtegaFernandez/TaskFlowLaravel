@extends('layouts.dashboard')

@section('title', 'Modificar tasca - TaskFlow')
@section('header-title', 'TASCA')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENT</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
@include('components.formulario-crea-tasca', compact('tasca', 'treballadors', 'departaments', 'categories'))
@endsection
