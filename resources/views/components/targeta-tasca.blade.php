@props(['tasca', 'mode' => 'treballador'])

@php
    $colorTasca = in_array($tasca->estat, ['fet', 'revisat'], true)
        ? 'finalitzada'
        : ($tasca->prioritat === 'urgent' ? 'urgent' : 'pendent');
@endphp

<article class="tasca tasca--{{ $colorTasca }}">
    <h3 class="tasca__titol">{{ $tasca->nom_tas }}</h3>

    <div class="tasca__fila">
        
        @if ($tasca->data_inici)
            <span class="tasca__xip">
                {{ $tasca->data_inici->format('d/m/Y') }}
            </span>
        @endif


        <span class="tasca__xip tasca__xip--{{ $tasca->prioritat }}">
            {{ ucfirst($tasca->prioritat) }}
        </span>

        @if ($mode === 'cap' && $tasca->assignat)
            <span class="tasca__xip">
                {{ $tasca->assignat->nom_usu }}
            </span>
        @endif

        @if ($tasca->estat === 'fet')
            <span class="tasca__xip tasca__xip--fet">
                Fet
            </span>
        @elseif ($tasca->estat === 'revisat')
            <span class="tasca__xip tasca__xip--revisada">
                Revisada
            </span>
        @endif
    </div>

    <div class="tasca__accions">
        <a class="tasca__boto" href="{{ route('tasca.show', ['tasca' => $tasca, 'origen' => 'dashboard']) }}">
            VEURE
        </a>

        @if ($mode === 'treballador' && !$tasca->activa && $tasca->estat !== 'fet' && $tasca->estat !== 'revisat')
            <p class="admin-panel__description">Aquesta tasca està desactivada.</p>
        @elseif ($mode === 'treballador' && $tasca->estat !== 'fet' && $tasca->estat !== 'revisat')
            <form method="POST" action="{{ route('tasca.fet', $tasca) }}">
                @csrf

                <button class="tasca__boto" type="submit">
                    FET
                </button>
            </form>
        @endif

        @if ($mode === 'cap' && $tasca->estat === 'fet')
            <form method="POST" action="{{ route('tasca.revisar', $tasca) }}">
                @csrf

                <button class="tasca__boto" type="submit">
                    REVISAT
                </button>
            </form>
        @endif
    </div>
</article>
