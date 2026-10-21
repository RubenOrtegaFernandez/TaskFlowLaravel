@props(['tasca', 'mode' => 'treballador'])

<article class="tasca">
    <img class="vidre-fons" src="{{ asset('img/background2.jpg') }}" alt="" aria-hidden="true">
    <h3 class="tasca__titol">{{ $tasca->nom_tas }}</h3>

    <div class="tasca__fila">
        
        @if ($tasca->data_inici)
            <span class="tasca__xip">
                {{ $tasca->data_inici->format('d/m/Y') }}
            </span>
        @endif


        <span class="tasca__xip">
            {{ ucfirst($tasca->prioritat) }}
        </span>

        @if ($mode === 'cap' && $tasca->assignat)
            <span class="tasca__xip">
                {{ $tasca->assignat->nom_usu }}
            </span>
        @endif

        @if ($tasca->estat === 'revisat')
            <span class="tasca__xip tasca__xip--revisada">
                Revisada
            </span>
        @endif
    </div>

    <div class="tasca__accions">
        <a class="tasca__boto" href="{{ route('tasca.show', $tasca) }}">
            VEURE TASCA
        </a>

        @if ($mode === 'treballador' && $tasca->estat !== 'fet' && $tasca->estat !== 'revisat')
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
