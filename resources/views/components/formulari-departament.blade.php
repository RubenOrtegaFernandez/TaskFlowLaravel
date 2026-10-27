@php
    $idsActuals = $treballadorsActuals->pluck('id_correu')->all();
    $idsSeleccionats = old('treballadors', $idsActuals);
    $capActual = $departament?->cap;
@endphp

<form class="tasca-card departament-form{{ $departament ? ' departament-form--edicio' : '' }}" data-vidre method="POST" action="{{ $departament ? route('departament.update', $departament) : route('departament.store') }}">
    @csrf

    <div class="tasca-card__header">
        @if ($departament)
            <h1 class="login-title">Modificar departament</h1>
            <p>Actualitza el nom, el cap i les persones assignades.</p>
        @else
            <h1 class="login-title">Agregar departamento</h1>
            <p>Crea un departament i assigna-hi un cap i treballadors.</p>
        @endif

        @if ($errors->any())
            <small>{{ $errors->first() }}</small>
        @endif
    </div>

    <div class="tasca-card__grid">
        <div class="tasca-card__col">
            <div class="tasca-caixa">
                <input type="text" name="nom" placeholder="Nom del departament" aria-label="Nom del departament" value="{{ old('nom', $departament->nom ?? '') }}" maxlength="25" required>
            </div>

            @if ($administrador)
                <div class="tasca-caixa tasca-desplegable">
                    <select name="id_cap" aria-label="Cap del departament">
                        <option value="">Sense cap assignat</option>
                        @foreach ($caps as $cap)
                            <option value="{{ $cap->id_correu }}" @selected(old('id_cap', $capActual->id_correu ?? null) == $cap->id_correu)>
                                {{ $cap->nom_usu }}{{ $cap->departament ? ' · ' . $cap->departament->nom : '' }}
                            </option>
                        @endforeach
                    </select>
                    <span><svg aria-hidden="true"><use xlink:href="#icon-fletxa"></use></svg></span>
                </div>
                <p class="departament-form__nota">Si selecciones un cap d'un altre departament, passarà a aquest.</p>
            @endif

            <fieldset class="departament-form__grup" data-vidre-camp>
                <legend>Treballadors actuals</legend>
                @if ($treballadorsActuals->isNotEmpty())
                    <div class="departament-form__llista">
                        @foreach ($treballadorsActuals as $treballador)
                            <label class="departament-form__persona">
                                <input type="checkbox" name="treballadors[]" value="{{ $treballador->id_correu }}" @checked(in_array($treballador->id_correu, $idsSeleccionats))>
                                <span>{{ $treballador->nom_usu }}</span>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="departament-form__buit">Aquest departament encara no té treballadors.</p>
                @endif
            </fieldset>
        </div>

        <div class="tasca-card__col">
            <fieldset class="departament-form__grup" data-vidre-camp>
                <legend>Treballadors disponibles</legend>
                @if ($treballadorsDisponibles->isNotEmpty())
                    <div class="departament-form__llista">
                        @foreach ($treballadorsDisponibles as $treballador)
                            <label class="departament-form__persona">
                                <input type="checkbox" name="treballadors[]" value="{{ $treballador->id_correu }}" @checked(in_array($treballador->id_correu, $idsSeleccionats))>
                                <span>{{ $treballador->nom_usu }}{{ $administrador && $treballador->departament ? ' · ' . $treballador->departament->nom : '' }}</span>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="departament-form__buit">No hi ha més treballadors disponibles.</p>
                @endif
                <p class="departament-form__nota">
                    @if ($administrador)
                        Pots assignar persones d'altres departaments o sense departament.
                    @else
                        Pots afegir persones sense departament al teu departament.
                    @endif
                </p>
            </fieldset>
        </div>
    </div>

    <div class="tasca-accions">
        <a class="btn btn--tornar" href="{{ route('departament.index') }}">Tornar enrere</a>
        <button class="btn btn--enviar" type="submit">{{ $departament ? 'Desar canvis' : 'Crear departament' }}</button>
    </div>
</form>
