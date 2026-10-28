<table class="llistat">
    <thead>
        <tr>
            <th>Categories</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->nom }}</td>
            </tr>
        @empty
            <tr><td>Encara no hi ha categories.</td></tr>
        @endforelse
    </tbody>
</table>
