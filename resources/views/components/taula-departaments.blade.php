<div class="taula-tasques">
    <table class="llistat llistat--departaments">
        <thead>
            <tr>
                <th>NOM DEL DEPARTAMENT</th>
                <th>CAP</th>
                <th>TREBALLADORS</th>
                <th>ACCIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($departaments as $departament)
                <tr>
                    <td>{{ $departament->nom }}</td>
                    <td>{{ $departament->cap?->nom_usu ?? 'Sense cap assignat' }}</td>
                    <td>{{ $departament->treballadors->count() }}</td>
                    <td class="col-accions">
                        <a href="{{ route('departament.show', $departament) }}" title="Veure departament" aria-label="Veure {{ $departament->nom }}">
                            <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-ull"></use></svg>
                        </a>
                        <a href="{{ route('departament.edit', $departament) }}" title="Modificar departament" aria-label="Modificar {{ $departament->nom }}">
                            <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-editar"></use></svg>
                        </a>
                        @if (auth()->user()->rol_tipus === 'admin')
                            <a href="{{ route('departament.delete', $departament) }}" title="Esborrar departament" aria-label="Esborrar {{ $departament->nom }}">
                                <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-eliminar"></use></svg>
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Encara no hi ha departaments.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
