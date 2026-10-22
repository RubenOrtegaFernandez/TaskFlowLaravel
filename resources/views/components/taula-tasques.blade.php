@props(['tasques'])

<table class="llistat">
    <thead>
        <tr>
            <th>NOM</th>
            <th>Descripció</th>
            <th>Data Inici</th>
            <th>Data Final</th>
            <th>Estat</th>
            <th>Prioritat</th>
            <th>Categoria</th>
            <th>Departament</th>
            <th>Creador</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasques as $tasca)
            <tr>
                <td>{{ $tasca->nom_tas }}</td>
                <td>{{ $tasca->descripcio }}</td>
                <td>{{ $tasca->data_inici }}</td>
                <td>{{ $tasca->data_final }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $tasca->estat)) }}</td>
                <td>{{ ucfirst($tasca->prioritat) }}</td>
                <td>{{ $tasca->categoria }}</td>
                <td>{{ $tasca->departament->nom ?? 'Sense departament' }}</td>
                <td>{{ $tasca->creador->nom_usu ?? '—' }}</td>
                <td class="col-accions">
                    <a href="{{ route('tasca.show', $tasca) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-eliminar"></use>
                        </svg>
                    </a>
                    <a href="{{ route('tasca.show', $tasca) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-ull"></use>
                        </svg>
                    </a>
                    <a href="{{ route('tasca.show', $tasca) }}" title="Veure">
                        <svg class="field__icon" aria-hidden="true">
                            <use xlink:href="#icon-editar"></use>
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>