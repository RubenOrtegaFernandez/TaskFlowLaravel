@props(['tasques'])

<div class="taula-tasques">
<table class="llistat llistat--tasques">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Descripció</th>
            <th>Estat</th>
            <th>Disponibilitat</th>
            <th>Categoria</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasques as $tasca)
            <tr>
                <td data-label="Nom">{{ $tasca->nom_tas }}</td>
                <td data-label="Descripció">{{ $tasca->descripcio }}</td>
                <td data-label="Estat">{{ ucfirst(str_replace('_', ' ', $tasca->estat)) }}</td>
                <td data-label="Disponibilitat">{{ $tasca->activa ? 'Activa' : 'Desactivada' }}</td>
                <td data-label="Categoria">{{ $tasca->categoria }}</td>
                <td class="col-accions" data-label="Accions">
                    <div class="tasca-taula-accions">
                    <a href="{{ route('tasca.show', ['tasca' => $tasca, 'origen' => 'tasques']) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-ull"></use>
                        </svg>
                    </a>
                    <a href="{{ route('tasca.edit', ['tasca' => $tasca, 'origen' => 'tasques']) }}" title="Editar">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-editar"></use>
                        </svg>
                    </a>
                    <a href="{{ route('tasca.delete', $tasca) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-eliminar"></use>
                        </svg>
                    </a>
                    @if (auth()->user()->rol_tipus === 'admin' || (auth()->user()->rol_tipus === 'cap' && $tasca->id_dep_assignat == auth()->user()->id_dep))
                        <form class="tasca-toggle-form" method="POST" action="{{ route('tasca.canviar-activa', $tasca) }}">
                            @csrf
                            <button class="btn tasca-toggle" type="submit">{{ $tasca->activa ? 'Desactivar' : 'Activar' }}</button>
                        </form>
                    @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
