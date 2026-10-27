@props(['tasques'])

<div class="taula-tasques" data-vidre-taula>
<table class="llistat">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Descripció</th>
            <th>Estat</th>
            <th>Categoria</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasques as $tasca)
            <tr>
                <td>{{ $tasca->nom_tas }}</td>
                <td>{{ $tasca->descripcio }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $tasca->estat)) }}</td>
                <td>{{ $tasca->categoria }}</td>
                <td class="col-accions">
                    <a href="{{ route('tasca.show', $tasca) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-ull"></use>
                        </svg>
                    </a>
                    <a href="{{ route('tasca.edit', $tasca) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-editar"></use>
                        </svg>
                    </a>
                    <a href="{{ route('tasca.delete', $tasca) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-eliminar"></use>
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
