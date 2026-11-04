@extends('layouts.dashboard')

@section('title', 'Cap · TaskFlow')

@section('content')

@if (session('status'))
    <div class="missatge-popup" id="missatgePopup" role="alert" data-timeout="10000">
        <p class="admin-panel__description">{{ session('status') }}</p>
        <button type="button" class="missatge-popup__close" id="missatgePopupClose" aria-label="Cerrar">&times;</button>
    </div>
@endif

<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title">Tasques Urgents</h2>

    <div class="admin-panel__content">
        @forelse ($urgents as $tasca)
            @include('components.targeta-tasca', [
                'tasca' => $tasca,
                'mode' => 'cap'
            ])
        @empty
            <p class="admin-panel__description">No hi ha tasques urgents.</p>
        @endforelse
    </div>
    <div class="admin-panel__action">
        <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
        <a href="{{ route('tasca.create', ['prioritat' => 'urgent', 'origen' => 'dashboard']) }}" class="btn">Afegir</a>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title admin-panel__title--compact">Tasques Pendents de Revisió</h2>

    <div class="admin-panel__content">

        @forelse ($tasquesFetes as $tasca)
            @include('components.targeta-tasca', [
                'tasca' => $tasca,
                'mode' => 'cap'
            ])
        @empty
            <p class="admin-panel__description">No hi ha tasques finalitzades pendents de revisió.</p>
        @endforelse
    </div>
    <div class="admin-panel__action">
        <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
        <a href="{{ route('tasca.create', ['origen' => 'dashboard']) }}" class="btn">Afegir</a>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Treballadors</h2>

    <div class="admin-panel__content admin-panel__content--simple targeta-vidre">
        @forelse ($treballadors as $treballador)
            <a href="{{ route('usuari.show', $treballador) }}">
                <img
                    class="perfil__avatar"
                    src="{{ asset($treballador->img ?: 'img/default.png') }}"
                    alt="Foto del perfil de {{ $treballador->nom_usu }}">
                <span>{{ $treballador->nom_usu }}</span>
            </a>
        @empty
            <p class="admin-panel__description">Encara no hi ha treballadors al teu departament.</p>
        @endforelse
    </div>
</section>
@endsection
