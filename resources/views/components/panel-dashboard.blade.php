<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title">Tasques Urgents</h2>
    <p class="admin-panel__description">Aquí es mostraran les tasques a punt de finalitzar.</p>

    <div class="admin-panel__action">
        <span class="admin-panel__action-text">Vols afegir tasques? fes-ho aquí</span>
        <a href="{{ route('tasca.create') }}" class="btn">Afegir</a>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Categories</h2>
    <p class="admin-panel__description">Aquí es mostraran les categories que vagis creant!</p>

    <div class="admin-panel__action">
        <span class="admin-panel__action-text">Vols afegir categories? fes-ho aquí</span>
        <a href="{{ route('tasca.create') }}" class="btn">Afegir</a>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Departaments</h2>
    <p class="admin-panel__description">Aquí es mostraran els departaments de la teva empresa.</p>

    <div class="admin-panel__action">
        <span class="admin-panel__action-text">Vols afegir departaments? fes-ho aquí</span>
        <a href="{{ route('tasca.create') }}" class="btn">Afegir</a>
    </div>
</section>