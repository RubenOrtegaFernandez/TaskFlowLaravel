@extends('layouts.dashboard')

@section('title', 'Treballador · TaskFlow')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('tasca.index') }}">Tasques</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">Departaments</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">Treballadors</a>
    

@endsection

@section('content')
@if (session('status'))
    <p class="admin-panel__description">{{ session('status') }}</p>
@endif
<section class="admin-panel admin-panel--highlight">
    <h2 class="admin-panel__title">Tasques Urgents</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        <p class="admin-panel__description">Aquí es mostraran les teves tasques a punt de finalitzar.</p>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Tasques Pendents</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        <p class="admin-panel__description">Aquí es mostraran les tasques que tens assignades.</p>
    </div>
</section>

<section class="admin-panel">
    <h2 class="admin-panel__title">Tasques Finalitzades</h2>

    <div class="admin-panel__content admin-panel__content--simple">
        <p class="admin-panel__description">Aquí es mostraran les tasques que has finalitzat.</p>
    </div>
</section>
@endsection