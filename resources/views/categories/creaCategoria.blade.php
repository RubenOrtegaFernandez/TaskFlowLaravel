@extends('layouts.dashboard')

@section('title', 'Crear categoria · TaskFlow')
@section('header-title', 'CATEGORIES')

@section('header-nav')
    <a class="admin-header__link" href="{{ route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENTS</a>
    <a class="admin-header__link" href="{{ route('usuari.index') }}">TREBALLADORS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
    <form class="tasca-card categoria-form" data-vidre method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="tasca-card__header">
            <h1 class="login-title">Crear categoria</h1>
            <p>Afegeix una categoria perquè es pugui seleccionar en crear tasques.</p>
            @if ($errors->any())
                <small>{{ $errors->first() }}</small>
            @endif
        </div>

        <div class="tasca-card__grid">
            <div class="tasca-card__col">
                <label class="categoria-form__camp" for="nom-categoria">Nom de la categoria</label>
                <div class="tasca-caixa">
                    <input
                        id="nom-categoria"
                        type="text"
                        name="nom"
                        placeholder="Ex.: Suport"
                        value="{{ old('nom') }}"
                        maxlength="25"
                        autocomplete="off"
                        required
                    >
                </div>
                @error('nom')
                    <small class="categoria-form__error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="tasca-accions">
            <a class="btn btn--tornar" href="{{ route('dashboardadmin.index') }}">Tornar enrere</a>
            <button class="btn btn--enviar" type="submit">Crear categoria</button>
        </div>
    </form>
@endsection
