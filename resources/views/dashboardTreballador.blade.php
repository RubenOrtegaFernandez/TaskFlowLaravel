@extends('layouts.dashboard')

@section('title', 'Treballador · TaskFlow')

@section('content')
@if (session('status'))
    <div class="alert alert-warning">
        {{ session('status') }}
        <button onclick="this.parentElement.remove()" class="btn">X</button>
    </div>
@endif
<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title">En procés</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí es mostraran totes les tasques.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols veure-les totes? ves-hi!</span>
            <button class="btn" type="button">Veure</button>
        </div>
    </div>
</section>

<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title admin-panel__title--tight">Urgents</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí es mostraran les tasques finalitzades pendents de revisió.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols veure-les totes? ves-hi!</span>
            <button class="btn" type="button">Veure</button>
        </div>
    </div>
</section>

<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title">Pendents de Revisió</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí podràs veure totes les tasques finalitzades pendents de revisió.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols veure-les totes? ves-hi!</span>
            <button class="btn" type="button">Veure</button>
        </div>
    </div>
</section>
@endsection
