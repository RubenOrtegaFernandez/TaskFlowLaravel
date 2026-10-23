@props(['tasques'])

<table class="llistat">
    <tbody>
        @foreach ($departaments as $departament)
            <tr>
                <td>{{ $departament->nom }}</td>
            </tr>
        @endforeach
    </tbody>
</table>