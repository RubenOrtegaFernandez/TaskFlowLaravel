@props(['tasques'])

<table class="llistat">
    <thead>
        <tr>
            <th>Departaments</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departaments as $departament)
            <tr>
                <td>{{ $departament->nom }}</td>
            </tr>
        @endforeach
    </tbody>
</table>