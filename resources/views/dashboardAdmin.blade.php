@extends('layouts.dashboard')

@section('title', 'Admin · TaskFlow')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('tasca.index') }}">Tasques</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">Departaments</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">Treballadors</a>
@endsection

@section('content')
@if (session('status'))
    <p class="admin-panel__description">{{ session('status') }}</p>
@endif

@include('components.panel-dashboard')
@endsection