
@extends('layouts.dashboard')

@section('title', 'Treballador · TaskFlow')

@section('header-title', 'TASQUES')

@section('sense-nav', 'si')

@section('content')
    @if (session('status'))
        <div class="missatge-popup" id="missatgePopup" role="alert" data-timeout="10000">
            <p class="admin-panel__description">{{ session('status') }}</p>
            <button type="button" class="missatge-popup__close" id="missatgePopupClose" aria-label="Cerrar">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="missatge-popup" id="missatgePopup" role="alert" data-timeout="10000">
            <p class="admin-panel__description">{{ session('error') }}</p>
            <button type="button" class="missatge-popup__close" id="missatgePopupClose" aria-label="Cerrar">&times;</button>
        </div>
    @endif

    <section class="admin-panel admin-panel--highlight">
        <h2 class="admin-panel__title">Tasques Urgents</h2>

        <div class="admin-panel__content admin-panel__content--simple">
            @forelse ($urgents as $tasca)
                @include('components.targeta-tasca', [
                    'tasca' => $tasca,
                    'mode' => 'treballador'
                ])
            @empty
                <p class="admin-panel__description">No tens tasques urgents.</p>
            @endforelse
        </div>
    </section>

    <section class="admin-panel">
        <h2 class="admin-panel__title">Tasques Pendents</h2>

        <div class="admin-panel__content admin-panel__content--simple">
            @forelse ($pendents as $tasca)
                @include('components.targeta-tasca', [
                    'tasca' => $tasca,
                    'mode' => 'treballador'
                ])
            @empty
                <p class="admin-panel__description">No tens tasques pendents.</p>
            @endforelse
        </div>
    </section>

    <section class="admin-panel">
        <h2 class="admin-panel__title">Tasques Finalitzades</h2>

        <div class="admin-panel__content admin-panel__content--simple">
            @forelse ($finalitzades as $tasca)
                @include('components.targeta-tasca', [
                    'tasca' => $tasca,
                    'mode' => 'treballador'
                ])
            @empty
                <p class="admin-panel__description">Encara no has finalitzat cap tasca.</p>
            @endforelse
        </div>
    </section>
@endsection
