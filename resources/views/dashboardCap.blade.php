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
        <p class="admin-panel__description">Aquí es mostraran les tasques a punt de finalitzar.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
            <a href="{{ route('tasca.create', ['prioritat' => 'urgent', 'origen' => 'dashboard']) }}" class="btn">Afegir</a>
        </div>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title admin-panel__title--compact">Tasques Pendents de Revisió</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí es mostraran les tasques finalitzades pendents de revisió.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
            <a href="{{ route('tasca.create', ['origen' => 'dashboard']) }}" class="btn">Afegir</a>
        </div>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Treballadors</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        @forelse ($treballadors as $treballador)
            <p class="admin-panel__description">{{ $treballador->nom_usu }}</p>
        @empty
            <p class="admin-panel__description">Encara no hi ha treballadors al teu departament.</p>
        @endforelse
    </div>
</section>
@endsection
