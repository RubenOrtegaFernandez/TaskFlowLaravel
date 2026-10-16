<table class="llista-tasques__taula">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Data Inici</th>
            <th>Data Final</th>
            <th>Estat</th>
            <th>Prioritat</th>
            <th>Categoria</th>
            <th>Departament</th>
            <th>Data final</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasques as $tasca)
            <tr>
                <td>{{ $tasca->nom_tas }}</td>
                <td>{{ $tasca->data_inici }}</td>
                <td>{{ $tasca->data_final }}</td>
                <td>{{ $tasca->estat }}</td>
                <td>{{ $tasca->prioritat }}</td>
                <td>{{ $tasca->categoria }}</td>
                <td>{{ $tasca->departament->nom ?? '—' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>