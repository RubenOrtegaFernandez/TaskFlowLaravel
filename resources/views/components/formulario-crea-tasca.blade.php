<form class="tasca-card" method="POST" action="{{ route('tasca.store') }}">
    @csrf

    <div class="tasca-card__header">
        <h1 class="login-title">Afegeix una tasca</h1>
        <p class="tasca-subtitle">Afegeix una nova tasca indicant-ne el títol, la descripció i els detalls necessaris.</p>
    </div>

    @error('nom_tas')
        <small class="tasca-card__error">{{ $message }}</small>
    @enderror

    <div class="tasca-card__grid">
        {{-- Columna Esquerra --}}
        <div class="tasca-col">
            <div class="field">
                <label class="field__label" for="nom_tas">Nom de la tasca</label>
                <input class="field__input" type="text" id="nom_tas" name="nom_tas" placeholder="Nom de la tasca" value="{{ old('nom_tas') }}" required>
            </div>

            <div class="field-group">
                <div class="field">
                    <label class="field__label" for="data_inici">Data d'inici</label>
                    <input class="field__input" type="date" id="data_inici" name="data_inici" value="{{ old('data_inici') }}" required>
                </div>

                <div class="field">
                    <label class="field__label" for="data_final">Data final</label>
                    <input class="field__input" type="date" id="data_final" name="data_final" value="{{ old('data_final') }}" required>
                </div>
            </div>

            <div class="field">
                <label class="field__label" for="id_usr_assignat">Selecciona un treballador</label>
                <select class="field__input" id="id_usr_assignat" name="id_usr_assignat">
                    <option value="" {{ old('id_usr_assignat') ? '' : 'selected' }}>Sense assignar</option>
                    @if(isset($usuaris))
                        @foreach($usuaris as $usr)
                            <option value="{{ $usr->id }}" {{ old('id_usr_assignat') == $usr->id ? 'selected' : '' }}>{{ $usr->nom }} {{ $usr->cognoms ?? '' }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        {{-- Columna Dreta --}}
        <div class="tasca-col">
            <div class="field">
                <label class="field__label" for="descripcio">Afegeix una petita descripció...</label>
                <textarea class="field__input field__textarea" id="descripcio" name="descripcio" placeholder="Escriu els detalls de la tasca...">{{ old('descripcio') }}</textarea>
            </div>

            <div class="field-group">
                <div class="field">
                    <label class="field__label" for="categoria">Categoria</label>
                    <select class="field__input" id="categoria" name="categoria" required>
                        <option value="" disabled {{ old('categoria') ? '' : 'selected' }}>Selecciona</option>
                        <option value="General" {{ old('categoria') == 'General' ? 'selected' : '' }}>General</option>
                        <option value="Desenvolupament" {{ old('categoria') == 'Desenvolupament' ? 'selected' : '' }}>Desenvolupament</option>
                        <option value="Disseny" {{ old('categoria') == 'Disseny' ? 'selected' : '' }}>Disseny</option>
                        <option value="Manteniment" {{ old('categoria') == 'Manteniment' ? 'selected' : '' }}>Manteniment</option>
                    </select>
                </div>

                <div class="field">
                    <label class="field__label" for="id_dep_assignat">Departament</label>
                    <select class="field__input" id="id_dep_assignat" name="id_dep_assignat">
                        <option value="" {{ old('id_dep_assignat') ? '' : 'selected' }}>Selecciona</option>
                        @if(isset($departaments))
                            @foreach($departaments as $dep)
                                <option value="{{ $dep->id }}" {{ old('id_dep_assignat') == $dep->id ? 'selected' : '' }}>{{ $dep->nom }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="field">
                    <label class="field__label" for="prioritat">Prioritat</label>
                    <select class="field__input" id="prioritat" name="prioritat" required>
                        <option value="" disabled {{ old('prioritat') ? '' : 'selected' }}>Selecciona</option>
                        <option value="Baixa" {{ old('prioritat') == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="Mitjana" {{ old('prioritat') == 'Mitjana' ? 'selected' : '' }}>Mitjana</option>
                        <option value="Alta" {{ old('prioritat') == 'Alta' ? 'selected' : '' }}>Alta</option>
                        <option value="Urgent" {{ old('prioritat') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
            </div>

            <div class="tasca-actions">
                <button class="btn btn--enviar" type="submit">ENVIAR</button>
            </div>
        </div>
    </div>
</form>