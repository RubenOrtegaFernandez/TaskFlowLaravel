@extends('layouts.dashboard')

@section('title', 'Admin · TaskFlow')

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
    <h2 class="admin-panel__title">Categories</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí es mostraran les categories que vagis creant!</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
            <button class="btn" type="button">Afegir</button>
        </div>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Departaments</h2>

    <div class="admin-panel__content">
        <p class="admin-panel__description">Aquí es mostraran els departaments de la teva empresa.</p>

        <div class="admin-panel__action">
            <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
            <button class="btn" type="button">Afegir</button>
        </div>
    </div>
</section>
@endsection
