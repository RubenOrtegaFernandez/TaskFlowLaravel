@extends('layouts.dashboard')

@section('title', 'Modificar usuari · TaskFlow')
@section('header-title', 'TREBALLADORS')

@section('header-nav')
    <a class="admin-header__link" href="{{ auth()->user()->rol_tipus === 'cap' ? route('dashboardcap.index') : route('dashboardadmin.index') }}">DASHBOARD</a>
    <a class="admin-header__link" href="{{ route('tasca.index') }}">TASQUES</a>
    <a class="admin-header__link" href="{{ route('departament.index') }}">DEPARTAMENTS</a>
    <a class="admin-header__link" href="{{ route('categories.index') }}">CATEGORIES</a>
@endsection

@section('content')
<form class="tasca-card usuari-form{{ $administrador ? '' : ' usuari-form--cap' }}" data-vidre method="POST" action="{{ route('usuari.update', $usuari) }}">
    @csrf

    <div class="tasca-card__header">
        <h1 class="login-title">Modificar usuari</h1>
        <p>Actualitza les dades de {{ $usuari->nom_usu }}.</p>
        @if ($errors->any())
            <small>{{ $errors->first() }}</small>
        @endif
    </div>

    <div class="tasca-card__grid">
        <div class="tasca-card__col">
            <label class="usuari-form__camp">
                <span>Nom</span>
                <div class="tasca-caixa"><input type="text" name="nom_usu" value="{{ old('nom_usu', $usuari->nom_usu) }}" maxlength="25" autocomplete="name" required></div>
                @error('nom_usu') <small>{{ $message }}</small> @enderror
            </label>

            <label class="usuari-form__camp">
                <span>Correu electrònic</span>
                <div class="tasca-caixa"><input type="email" name="correu" value="{{ old('correu', $usuari->correu) }}" maxlength="255" autocomplete="email" required></div>
                @error('correu') <small>{{ $message }}</small> @enderror
            </label>

            @if ($administrador)
                <label class="usuari-form__camp">
                    <span>Rol</span>
                    <div class="tasca-caixa tasca-desplegable">
                        <select name="rol_tipus" required>
                            <option value="admin" @selected(old('rol_tipus', $usuari->rol_tipus) === 'admin')>Administrador</option>
                            <option value="cap" @selected(old('rol_tipus', $usuari->rol_tipus) === 'cap')>Cap de departament</option>
                            <option value="client" @selected(old('rol_tipus', $usuari->rol_tipus) === 'client')>Treballador</option>
                        </select>
                        <span><svg aria-hidden="true"><use xlink:href="#icon-fletxa"></use></svg></span>
                    </div>
                    @error('rol_tipus') <small>{{ $message }}</small> @enderror
                </label>
            @endif
        </div>

        <div class="tasca-card__col">
            @if ($administrador)
                <label class="usuari-form__camp">
                    <span>Departament</span>
                    <div class="tasca-caixa tasca-desplegable">
                        <select name="id_dep">
                            <option value="">Sense departament</option>
                            @foreach ($departaments as $departament)
                                <option value="{{ $departament->id_dep }}" @selected((string) old('id_dep', $usuari->id_dep) === (string) $departament->id_dep)>{{ $departament->nom }}</option>
                            @endforeach
                        </select>
                        <span><svg aria-hidden="true"><use xlink:href="#icon-fletxa"></use></svg></span>
                    </div>
                    @error('id_dep') <small>{{ $message }}</small> @enderror
                </label>
            @endif

            @if ($administrador)
                <label class="usuari-form__camp">
                    <span>Nova contrasenya <small>(opcional)</small></span>
                    <div class="tasca-caixa"><input type="password" name="contrasenya_nova" autocomplete="new-password" minlength="8"></div>
                    @error('contrasenya_nova') <small>{{ $message }}</small> @enderror
                </label>

                <label class="usuari-form__camp">
                    <span>Repeteix la contrasenya</span>
                    <div class="tasca-caixa"><input type="password" name="contrasenya_nova_confirmation" autocomplete="new-password" minlength="8"></div>
                </label>
                <p class="usuari-form__nota">Deixa els camps de contrasenya buits per conservar l’actual.</p>
            @endif
        </div>
    </div>

    <div class="tasca-accions">
        <a class="btn btn--tornar" href="{{ route('usuari.index') }}">Tornar al llistat</a>
        <button class="btn btn--enviar" type="submit">Desar canvis</button>
    </div>
</form>
@endsection
