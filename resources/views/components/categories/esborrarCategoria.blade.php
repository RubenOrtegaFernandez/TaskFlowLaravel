@extends('layouts.dashboard')

@section('title', 'Esborrar Categoria')
@section('header-title', 'Categoria')


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
<section class="tasca-eliminacio" data-tasca-eliminacio data-esborrany novalidate>
    <div class="tasca-eliminacio__card">
        <p class="tasca-eliminacio__etiqueta">CONFIRMAR ELIMINACIÓ</p>
        <h2>Vols esborrar aquesta categoria?</h2>
        <p class="tasca-eliminacio__missatge">
            La categoria <strong>{{ $categoria->nom_cat }}</strong> s'esborrarà definitivament. Aquesta acció no es pot desfer.
        </p>

        @if ($categoria->tasques_count > 0)
            <small>Aquesta categoria s'utilitza en {{ $categoria->tasques_count }} {{ $categoria->tasques_count === 1 ? 'tasca' : 'tasques' }}, per això no es pot esborrar.</small>
        @endif

        <form method="POST" action="{{ route('categories.destroy', $categoria) }}">
            @csrf
            <div class="tasca-accions tasca-eliminacio__accions">
                <a class="btn btn--tornar" href="{{ route('categories.index') }}">Cancel·lar</a>
                <button class="btn btn--eliminar" type="submit" @disabled($categoria->tasques_count > 0)>Esborrar categoria</button>
            </div>
        </form>
    </div>
</section>
@endsection