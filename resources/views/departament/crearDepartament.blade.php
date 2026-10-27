@extends('layouts.dashboard')

@section('title', 'Crear departament - TaskFlow')
@section('header-title', 'DEPARTAMENTS')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('treballadors.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
    @include('components.formulari-departament')
@endsection
