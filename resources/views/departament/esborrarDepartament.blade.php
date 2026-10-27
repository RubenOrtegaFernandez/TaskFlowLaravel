@extends('layouts.dashboard')

@section('title', 'Esborrar departament - TaskFlow')
@section('header-title', 'DEPARTAMENTS')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('treballadors.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<section class="tasca-eliminacio" data-tasca-eliminacio>
    <div class="tasca-eliminacio__card">
        <p class="tasca-eliminacio__etiqueta">Confirmar eliminació</p>
        <h2>Vols esborrar aquest departament?</h2>
        <p class="tasca-eliminacio__missatge">
            El departament <strong>{{ $departament->nom }}</strong> s'esborrarà. Les persones i tasques es conservaran sense departament.
        </p>

        <form method="POST" action="{{ route('departament.destroy', $departament) }}">
            @csrf
            <div class="tasca-accions tasca-eliminacio__accions">
                <a class="btn btn--tornar" href="{{ route('departament.index') }}">Cancel·lar</a>
                <button class="btn btn--eliminar" type="submit">Esborrar departament</button>
            </div>
        </form>
    </div>
</section>
@endsection
