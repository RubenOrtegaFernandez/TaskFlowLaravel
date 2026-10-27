<div class="taula-tasques">
    <table class="llistat llistat--usuaris">
        <thead>
            <tr>
                <th>FOTO</th>
                <th>NOM</th>
                <th>CORREU</th>
                <th>DEPARTAMENT</th>
                <th>CAP</th>
                <th>ROL</th>
                <th>ACCIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($treballadors as $treballador)
                <tr>
                    <td class="usuari-taula__foto" data-label="Foto">
                        <img src="{{ asset($treballador->foto_perfil ?: 'img/default.png') }}" alt="Foto de {{ $treballador->nom_usu }}" loading="lazy">
                    </td>
                    <td data-label="Nom">{{ $treballador->nom_usu }}</td>
                    <td data-label="Correu">{{ $treballador->correu }}</td>
                    <td data-label="Departament">{{ $treballador->departament?->nom ?? 'Sense departament' }}</td>
                    <td data-label="Cap">{{ $treballador->rol_tipus === 'cap' ? 'Aquest usuari és el cap' : ($treballador->departament?->cap?->nom_usu ?? 'Sense cap') }}</td>
                    <td data-label="Rol">{{ ['admin' => 'Administrador', 'cap' => 'Cap', 'client' => 'Treballador'][$treballador->rol_tipus] ?? $treballador->rol_tipus }}</td>
                    <td class="col-accions" data-label="Accions">
                        <a href="{{ route('usuari.show', $treballador) }}" title="Veure usuari" aria-label="Veure {{ $treballador->nom_usu }}">
                            <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-ull"></use></svg>
                        </a>
                        @if (auth()->user()->rol_tipus === 'admin' || (auth()->user()->rol_tipus === 'cap' && $treballador->rol_tipus === 'client'))
                            <a href="{{ route('usuari.edit', $treballador) }}" title="Modificar usuari" aria-label="Modificar {{ $treballador->nom_usu }}">
                                <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-editar"></use></svg>
                            </a>
                        @endif
                        @if (auth()->user()->rol_tipus === 'admin')
                            @if (auth()->id() != $treballador->id_correu)
                                <a href="{{ route('usuari.delete', $treballador) }}" title="Esborrar usuari" aria-label="Esborrar {{ $treballador->nom_usu }}">
                                    <svg class="field__icon" aria-hidden="true"><use xlink:href="#icon-eliminar"></use></svg>
                                </a>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Encara no hi ha usuaris.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
