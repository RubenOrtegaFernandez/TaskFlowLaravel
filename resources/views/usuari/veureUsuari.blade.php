@extends('layouts.dashboard')

@section('title', $usuari->nom_usu . ' · TaskFlow')
@section('header-title', 'TREBALLADORS')

@section('header-nav')
    <a class="admin-header__link" href="{{ auth()->user()->rol_tipus === 'cap' ? route('dashboardcap.index') : route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENTS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<div class="tasca-detall usuari-detall">
    <section class="tasca-detall__superficie usuari-detall__superficie" data-vidre-detall>
        <div class="usuari-detall__capcalera">
            <img src="{{ asset($usuari->foto_perfil ?: 'img/default.png') }}" alt="Foto de {{ $usuari->nom_usu }}">
            <div>
                <p class="departament-detall__etiqueta">Fitxa d’usuari</p>
                <h2 class="departament-detall__titol">{{ $usuari->nom_usu }}</h2>
                <span>{{ ['admin' => 'Administrador', 'cap' => 'Cap de departament', 'client' => 'Treballador'][$usuari->rol_tipus] ?? $usuari->rol_tipus }}</span>
            </div>
        </div>

        <table class="llistat llistat--detall usuari-detall__taula">
            <tbody>
                <tr><th>Correu electrònic</th><td>{{ $usuari->correu }}</td></tr>
                <tr><th>Departament</th><td>{{ $usuari->departament?->nom ?? 'Sense departament' }}</td></tr>
                <tr><th>Cap del departament</th><td>{{ $usuari->departament?->cap?->nom_usu ?? ($usuari->rol_tipus === 'cap' ? 'Aquest usuari és el cap' : 'Sense cap assignat') }}</td></tr>
                <tr><th>Tasques assignades</th><td>{{ $usuari->tasques_assignades_count }}</td></tr>
                <tr><th>Tasques creades</th><td>{{ $usuari->tasques_creades_count }}</td></tr>
            </tbody>
        </table>
    </section>

    <div class="tasca-accions">
        <a class="btn btn--tornar" href="{{ route('usuari.index') }}">Tornar al llistat</a>
    </div>
</div>
@endsection
