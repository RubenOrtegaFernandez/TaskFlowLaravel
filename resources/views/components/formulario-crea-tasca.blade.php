@php($tasca = $tasca ?? null)

<form class="tasca-card" data-vidre method="POST" action="{{ $tasca ? route('tasca.update', $tasca) : route('tasca.store', ($prioritatFixa ?? false) ? ['prioritat' => 'urgent'] : []) }}">
    @csrf

    <div class="tasca-card__header">
        @if ($tasca)
            <h1 class="login-title">Modificar Tasca</h1>
            <p>Modifica les dades de la tasca i desa els canvis.</p>
        @else
            <h1 class="login-title">Afegeix una tasca</h1>
            <p>Afegeix una tasca nova amb el títol, la descripció i els detalls necessaris.</p>
        @endif
        @if ($errors->any())
            <small>{{ $errors->first() }}</small>
        @endif
    </div>

    <div class="tasca-card__grid">
        <div class="tasca-card__col">
            <div class="tasca-caixa">
                <input type="text" name="nom_tas" placeholder="Nom de la tasca" aria-label="Nom de la tasca" value="{{ old('nom_tas', $tasca->nom_tas ?? '') }}" maxlength="25" required>
            </div>

            <div class="tasca-dates">
                <label class="tasca-caixa tasca-data">
                    Data d'inici
                    <input type="date" name="data_inici" value="{{ old('data_inici', $tasca?->data_inici?->format('Y-m-d')) }}" required>
                </label>

                <label class="tasca-caixa tasca-data">
                    Data final
                    <input type="date" name="data_final" value="{{ old('data_final', $tasca?->data_final?->format('Y-m-d')) }}">
                </label>
            </div>

            <div class="tasca-caixa tasca-treballadors">
                <label for="id_usr_assignat">Selecciona un treballador</label>
                <div>
                    <select id="id_usr_assignat" name="id_usr_assignat" size="5">
                        <option value="" @selected(! old('id_usr_assignat', $tasca->id_usr_assignat ?? null))>Sense assignar</option>

                        @foreach ($departaments as $departament)
                            @if ($departament->treballadors->isNotEmpty())
                                <optgroup label="DEPARTAMENT {{ mb_strtoupper($departament->nom) }}">
                                    @foreach ($departament->treballadors as $treballador)
                                        <option value="{{ $treballador->id_correu }}" @selected(old('id_usr_assignat', $tasca->id_usr_assignat ?? null) == $treballador->id_correu)>{{ $treballador->nom_usu }}</option>
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="tasca-card__col">
            <div class="tasca-caixa tasca-descripcio">
                <textarea name="descripcio" placeholder="Afegeix una petita descripció" aria-label="DescripciÃ³" maxlength="255" required>{{ old('descripcio', $tasca->descripcio ?? '') }}</textarea>
            </div>

            <div class="tasca-desplegables">
                <div class="tasca-caixa tasca-desplegable">
                    <select name="categoria" aria-label="Categoria" required>
                        <option value="" disabled @selected(! old('categoria', $tasca->categoria ?? null))>Categoria</option>
                        @foreach ($categories as $categoria)
                            <option value="{{ $categoria }}" @selected(old('categoria', $tasca->categoria ?? null) == $categoria)>{{ $categoria }}</option>
                        @endforeach
                    </select>
                    <span>
                        <svg aria-hidden="true">
                            <use xlink:href="#icon-fletxa"></use>
                        </svg>
                    </span>
                </div>

                <div class="tasca-caixa tasca-desplegable">
                    <select name="id_dep_assignat" aria-label="Departament">
                        <option value="" @selected(! old('id_dep_assignat', $tasca->id_dep_assignat ?? null))>Departament</option>
                        @foreach ($departaments as $departament)
                            <option value="{{ $departament->id_dep }}" @selected(old('id_dep_assignat', $tasca->id_dep_assignat ?? null) == $departament->id_dep)>{{ $departament->nom }}</option>
                        @endforeach
                    </select>
                    <span>
                        <svg aria-hidden="true">
                            <use xlink:href="#icon-fletxa"></use>
                        </svg>
                    </span>
                </div>

                @if (!$tasca && ($prioritatFixa ?? false))
                    <div class="tasca-caixa tasca-prioritat-fixa" role="status" aria-label="Prioritat: Urgent">
                        Urgent
                    </div>
                @else
                    <div class="tasca-caixa tasca-desplegable">
                        <select name="prioritat" aria-label="Prioritat" required>
                            <option value="" disabled @selected(! old('prioritat', $tasca->prioritat ?? null))>Prioritat</option>
                            <option value="baixa" @selected(old('prioritat', $tasca->prioritat ?? null) == 'baixa')>Baixa</option>
                            <option value="mitja" @selected(old('prioritat', $tasca->prioritat ?? null) == 'mitja')>Mitjana</option>
                            <option value="alta" @selected(old('prioritat', $tasca->prioritat ?? null) == 'alta')>Alta</option>
                            <option value="urgent" @selected(old('prioritat', $tasca->prioritat ?? null) == 'urgent')>Urgent</option>
                        </select>
                        <span>
                            <svg aria-hidden="true">
                                <use xlink:href="#icon-fletxa"></use>
                            </svg>
                        </span>
                    </div>
                @endif
            </div>

            <div class="tasca-accions">
                @if ($tasca)
                    <a class="btn btn--tornar" href="{{ route('tasca.index') }}">Tornar al llistat</a>
                    <button class="btn btn--enviar" type="submit">Desar canvis</button>
                @else
                    <a class="btn btn--tornar" href="{{ route('dashboardadmin.index') }}">Tornar enrere</a>
                    <button class="btn btn--enviar" type="submit">Enviar</button>
                @endif
            </div>
        </div>
    </div>
</form>
