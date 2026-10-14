@extends('layouts.dashboard')

@section('title', 'Afegir tasca · TaskFlow')

@section('header-title', 'Afegir tasca')

@section('header-nav')
    <a class="admin-header__link" href="{{ route($rol === 'admin' ? 'admin' : 'cap') }}">Menú</a>
    <a class="admin-header__link" href="/tasques">Modificar tasca</a>
@endsection

@section('content')
    @include('components.formulario-tasca')
@endsection