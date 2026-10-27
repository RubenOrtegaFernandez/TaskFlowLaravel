@props(['tasques'])

<table class="llistat">
    <thead>
        <tr>
            <th>Categories</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->nom }}</td>
            </tr>
        @endforeach
    </tbody>
</table>