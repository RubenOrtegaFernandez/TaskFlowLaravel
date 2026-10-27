@props(['tasques'])

<table class="llistat">
    <thead>
        <tr>
            <th>Treballadors</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($treballadors as $treballador)
            <tr>
                <td>{{ $treballador->nom_usu }}</td>
            </tr>
        @endforeach
    </tbody>
</table>