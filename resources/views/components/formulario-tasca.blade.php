<form class="form-tasca" method="POST" action="{{ route('tasca.store') }}">
    @csrf

    <h2 class="form-tasca__titol">Afegeix una tasca</h2>
    <p class="form-tasca__subtitol">Afegeix una nova tasca indicant-ne el títol, la descripció i els detalls necessaris.</p>

    <div class="field">
        <label class="field__label" for="nom_tas">Nom de la tasca</label>
        <input class="field__input" type="text" id="nom_tas" name="nom_tas" value="{{ old('nom_tas') }}" required>
        @error('nom_tas')
            <small style="color: red; display: block;">{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="descripcio">Descripció</label>
        <textarea class="field__input" id="descripcio" name="descripcio" rows="4" required>{{ old('descripcio') }}</textarea>
        @error('descripcio')
            <small style="color: red; display: block;">{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="data_inici">Data d'inici</label>
        <input class="field__input" type="date" id="data_inici" name="data_inici" value="{{ old('data_inici') }}" required>
        @error('data_inici')
            <small style="color: red; display: block;">{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="data_final">Data final</label>
        <input class="field__input" type="date" id="data_final" name="data_final" value="{{ old('data_final') }}">
        @error('data_final')
            <small style="color: red; display: block;">{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="id_usr_assignat">Treballador</label>
        <select class="field__input" id="id_usr_assignat" name="id_usr_assignat">
            <option value="">Sense assignar</option>
            @foreach ($treballadors as $treballador)
                <option value="{{ $treballador->id_correu }}" {{ old('id_usr_assignat') == $treballador->id_correu ? 'selected' : '' }}>{{ $treballador->nom_usu }}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label class="field__label" for="categoria">Categoria</label>
        <select class="field__input" id="categoria" name="categoria" required>
            <option value="">Selecciona</option>
            @foreach ($categories as $categoria)
                <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
            @endforeach
        </select>
        @error('categoria')
            <small style="color: red; display: block;">{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="id_dep_assignat">Departament</label>
        <select class="field__input" id="id_dep_assignat" name="id_dep_assignat">
            <option value="">Selecciona</option>
            @foreach ($departaments as $departament)
                <option value="{{ $departament->id_dep }}" {{ old('id_dep_assignat') == $departament->id_dep ? 'selected' : '' }}>{{ $departament->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label class="field__label" for="prioritat">Prioritat</label>
        <select class="field__input" id="prioritat" name="prioritat" required>
            <option value="">Selecciona</option>
            <option value="baixa" {{ old('prioritat') == 'baixa' ? 'selected' : '' }}>Baixa</option>
            <option value="mitja" {{ old('prioritat') == 'mitja' ? 'selected' : '' }}>Mitja</option>
            <option value="alta" {{ old('prioritat') == 'alta' ? 'selected' : '' }}>Alta</option>
            <option value="urgent" {{ old('prioritat') == 'urgent' ? 'selected' : '' }}>Urgent</option>
        </select>
        @error('prioritat')
            <small style="color: red; display: block;">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn" type="submit">Enviar</button>
</form>