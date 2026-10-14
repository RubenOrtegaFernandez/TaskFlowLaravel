@extends('layouts.dashboard')

@section('title', 'Cap · TaskFlow')

@section('content')
<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title">Tasques Urgents</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí es mostraran les tasques a punt de finalitzar.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
            <button class="btn" type="button">Afegir</button>
        </div>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title admin-panel__title--compact">Tasques Pendents de Revisió</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí es mostraran les tasques finalitzades pendents de revisió.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
            <button class="btn" type="button">Afegir</button>
        </div>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Treballadors</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        <p class="admin-panel__description">Aquí es mostraran els treballadors que pertanyen al teu departament.</p>
    </div>
</section>
@endsection
