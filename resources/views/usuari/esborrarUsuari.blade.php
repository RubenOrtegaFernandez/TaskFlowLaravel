@extends('layouts.dashboard')

@section('title', 'Esborrar usuari · TaskFlow')
@section('header-title', 'TREBALLADORS')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENTS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="tasca-eliminacio" data-tasca-eliminacio>
    <div class="tasca-eliminacio__card">
        <p class="tasca-eliminacio__etiqueta">Confirmar eliminació</p>
        <h2>Vols esborrar aquest usuari?</h2>
        <p class="tasca-eliminacio__missatge">
            S’esborrarà el compte de <strong>{{ $usuari->nom_usu }}</strong> ({{ $usuari->correu }}). Les tasques es conservaran sense aquest usuari.
            @if ($usuari->rol_tipus === 'cap')
                El departament {{ $usuari->departament?->nom ?? 'sense departament' }} quedarà sense cap assignat.
            @endif
        </p>

        <form method="POST" action="{{ route('usuari.destroy', $usuari) }}">
            @csrf
            <div class="tasca-accions tasca-eliminacio__accions">
                <a class="btn btn--tornar" href="{{ route('usuari.index') }}">Cancel·lar</a>
                <button class="btn btn--eliminar" type="submit">Esborrar usuari</button>
            </div>
        </form>
    </div>
</section>
@endsection
