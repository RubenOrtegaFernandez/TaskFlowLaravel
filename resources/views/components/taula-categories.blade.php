<div class="taula-tasques">
    <table class="llistat llistat--categories">
        <thead>
            <tr>
                <th>NOM</th>
                <th>ACCIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $categoria)
                <tr>
                    <td>{{ $categoria->nom_cat }}</td>
                    <td class="col-accions">
                        <a href="{{ route('categories.edit', $categoria) }}" title="Modificar categoria" aria-label="Modificar {{ $categoria->nom }}">
                            <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-editar"></use></svg>
                        </a>
                        @if (auth()->user()->rol_tipus === 'admin')
                            <a href="{{ route('categories.delete', $categoria) }}" title="Esborrar categoria" aria-label="Esborrar {{ $categoria->nom }}">
                                <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-eliminar"></use></svg>
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Encara no hi ha categories.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
