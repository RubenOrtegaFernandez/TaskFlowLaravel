@extends('layouts.dashboard')

@section('title', 'Admin · TaskFlow')

@section('content')
    @if (session('status'))
        <div class="missatge-popup" id="missatgePopup" role="alert" data-timeout="10000">
            <p class="admin-panel__description">{{ session('status') }}</p>
            <button type="button" class="missatge-popup__close" id="missatgePopupClose" aria-label="Cerrar">&times;</button>
        </div>
    @endif

    <section class="admin-panel admin-panel--highlight">
        <h2 class="admin-panel__title">Tasques Urgents</h2>

        <div class="admin-panel__content admin-panel__content--simple">
            @forelse ($urgents as $tasca)
                @include('components.targeta-tasca', [
                    'tasca' => $tasca,
                    'mode' => 'admin'
                ])
            @empty
                <p class="admin-panel__description">No hi ha tasques urgents.</p>
            @endforelse
        </div>
    </section>

    <section class="admin-panel">
        <h2 class="admin-panel__title">Categories</h2>

        <div class="admin-panel__content admin-panel__content--simple">
            @forelse ($categories as $categoria)
                <div class="targeta-vidre is-liquid">
                    <span>{{ $categoria->nom_cat }}</span>
                </div>
            @empty
                <p class="admin-panel__description">Encara no hi ha categories.</p>
            @endforelse
        </div>
    </section>

    <section class="admin-panel">
        <h2 class="admin-panel__title">Departaments</h2>

        <div class="admin-panel__content admin-panel__content--simple">
            @forelse ($departaments as $departament)
                <div class="targeta-vidre is-liquid">
                    <span>{{ $departament->nom }}</span>
                </div>
            @empty
                <p class="admin-panel__description">Encara no hi ha departaments.</p>
            @endforelse
        </div>
    </section>
@endsection