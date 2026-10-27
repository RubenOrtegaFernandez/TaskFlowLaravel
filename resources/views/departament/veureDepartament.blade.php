@extends('layouts.dashboard')

@section('title', $departament->nom . ' - TaskFlow')
@section('header-title', 'DEPARTAMENTS')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('treballadors.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<div class="tasca-detall departament-detall">
    <section class="tasca-detall__superficie" data-vidre-detall>
        <p class="departament-detall__etiqueta">Departament</p>
        <h2 class="departament-detall__titol">{{ $departament->nom }}</h2>

        <div class="departament-detall__cap">
            <span>Cap del departament</span>
            <strong>{{ $departament->cap?->nom_usu ?? 'Sense cap assignat' }}</strong>
        </div>

        <h3 class="departament-detall__subtitol">Treballadors</h3>
        <table class="llistat departament-detall__taula">
            <thead>
                <tr><th>NOM</th><th>CORREU</th></tr>
            </thead>
            <tbody>
                @forelse ($departament->treballadors as $treballador)
                    <tr>
                        <td>{{ $treballador->nom_usu }}</td>
                        <td>{{ $treballador->correu }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2">Aquest departament encara no té treballadors.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="tasca-accions">
        <a class="btn btn--tornar" href="{{ route('departament.index') }}">Tornar al llistat</a>
    </div>
</div>
@endsection
