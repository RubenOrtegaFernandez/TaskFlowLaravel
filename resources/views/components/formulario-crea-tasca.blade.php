<form class="tasca-card" data-vidre method="POST" action="{{ route('tasca.store') }}">
    @csrf

    <div class="tasca-card__header">
        <h1 class="login-title">Afegeix una tasca</h1>
        <p>Afegeix una nova tasca indicant-ne el títol, la descripció i els detalls necessaris.</p>

        @if ($errors->any())
            <small>{{ $errors->first() }}</small>
        @endif
    </div>

    <div class="tasca-card__grid">
        <div class="tasca-card__col">
            <div class="tasca-caixa">
                <input type="text" name="nom_tas" placeholder="Nom de la tasca" aria-label="Nom de la tasca" value="{{ old('nom_tas') }}" maxlength="25" required>
            </div>

            <div class="tasca-dates">
                <label class="tasca-caixa tasca-data">
                    Data d'inici
                    <input type="date" name="data_inici" value="{{ old('data_inici') }}" required>
                </label>

                <label class="tasca-caixa tasca-data">
                    Data final
                    <input type="date" name="data_final" value="{{ old('data_final') }}" required>
                </label>
            </div>

            <div class="tasca-caixa tasca-treballadors">
                <label for="id_usr_assignat">Selecciona un treballador</label>
                <div>
                    <select id="id_usr_assignat" name="id_usr_assignat" size="5">
                        <option value="" @selected(! old('id_usr_assignat'))>Sense assignar</option>
                        @foreach ($treballadors as $treballador)
                            <option value="{{ $treballador->id_correu }}" @selected(old('id_usr_assignat') == $treballador->id_correu)>{{ $treballador->nom_usu }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="tasca-card__col">
            <div class="tasca-caixa tasca-descripcio">
                <textarea name="descripcio" placeholder="Afegeix una petita descripció..." aria-label="Descripció" maxlength="255" required>{{ old('descripcio') }}</textarea>
            </div>

            <div class="tasca-desplegables">
                <div class="tasca-caixa tasca-desplegable">
                    <select name="categoria" aria-label="Categoria" required>
                        <option value="" disabled @selected(! old('categoria'))>Categoria</option>
                        @foreach ($categories as $categoria)
                            <option value="{{ $categoria }}" @selected(old('categoria') == $categoria)>{{ $categoria }}</option>
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
                        <option value="" @selected(! old('id_dep_assignat'))>Departament</option>
                        @foreach ($departaments as $departament)
                            <option value="{{ $departament->id_dep }}" @selected(old('id_dep_assignat') == $departament->id_dep)>{{ $departament->nom }}</option>
                        @endforeach
                    </select>
                    <span>
                        <svg aria-hidden="true">
                            <use xlink:href="#icon-fletxa"></use>
                        </svg>
                    </span>
                </div>

                <div class="tasca-caixa tasca-desplegable">
                    <select name="prioritat" aria-label="Prioritat" required>
                        <option value="" disabled @selected(! old('prioritat'))>Prioritat</option>
                        <option value="baixa" @selected(old('prioritat') == 'baixa')>Baixa</option>
                        <option value="mitja" @selected(old('prioritat') == 'mitja')>Mitjana</option>
                        <option value="alta" @selected(old('prioritat') == 'alta')>Alta</option>
                        <option value="urgent" @selected(old('prioritat') == 'urgent')>Urgent</option>
                    </select>
                    <span>
                        <svg aria-hidden="true">
                            <use xlink:href="#icon-fletxa"></use>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="tasca-accions">
                <button class="btn btn--enviar" type="submit">Enviar</button>
            </div>
        </div>
    </div>
</form>