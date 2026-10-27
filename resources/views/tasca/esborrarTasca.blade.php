@extends('layouts.dashboard')

@section('title', 'Esborrar tasca - TaskFlow')
@section('header-title', 'TASCA')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENT</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="tasca-eliminacio" data-tasca-eliminacio>
    <div class="tasca-eliminacio__card">
        <p class="tasca-eliminacio__etiqueta">CONFIRMAR ELIMINACIÓ</p>
        <h2>Vols esborrar aquesta tasca?</h2>
        <p class="tasca-eliminacio__missatge">
            La tasca <strong>{{ $tasca->nom_tas }}</strong> s'esborrarà definitivament. Aquesta acció no es pot desfer.
        </p>

        <form method="POST" action="{{ route('tasca.destroy', $tasca) }}">
            @csrf
            <div class="tasca-accions tasca-eliminacio__accions">
                <a class="btn btn--tornar" href="{{ route('tasca.index') }}">Cancel·lar</a>
                <button class="btn btn--eliminar" type="submit">Esborrar tasca</button>
            </div>
        </form>
    </div>
</section>
@endsection
