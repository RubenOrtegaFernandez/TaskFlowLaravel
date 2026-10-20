@extends('layouts.dashboard')

@section('title', 'Treballador · TaskFlow')

@section('header-title', 'TASQUES')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENTS</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
@endsection

@section('content')
    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif

<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title">Tasques Urgents</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        <ul>
            @foreach ($urgents as $tasca)
                <li>{{ $tasca->nom_tas }}</li>
            @endforeach
        </ul>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Tasques Pendents</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        <ul>
            @foreach ($pendents as $tasca)
                <li>{{ $tasca->nom_tas }}</li>
            @endforeach
        </ul>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Tasques Finalitzades</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        <ul>
            @foreach ($finalitzades as $tasca)
                <li>{{ $tasca->nom_tas }}</li>
            @endforeach
        </ul>
    </div>
</section>
@endsection