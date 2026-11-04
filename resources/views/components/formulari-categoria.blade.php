@php 
    $categoria = $categoria ?? null; 
@endphp

<form class="tasca-card" data-vidre
      @if(!$categoria) data-esborrany @endif
      method="POST"
      action="{{ $categoria ? route('categories.update', $categoria) : route('categories.store') }}">
    @csrf

    <div class="tasca-card__header">
        @if ($categoria)
            <h1 class="login-title">Modificar Categoria</h1>
            <p>Modifica el nom de la categoria i desa els canvis.</p>
        @else
            <h1 class="login-title">Afegeix una categoria</h1>
            <p>Afegeix una categoria nova per classificar les tasques.</p>
        @endif
        @if ($errors->any())
            <small>{{ $errors->first() }}</small>
        @endif
    </div>

    <div class="tasca-card__grid">
        <div class="tasca-card__col">
            <div class="tasca-caixa">
                <input type="text" name="nom" placeholder="Nom de la categoria" aria-label="Nom de la categoria" value="{{ old('nom', $categoria->nom_cat ?? '') }}" maxlength="25" required>
            </div>
            <div class="tasca-accions">
                @if ($categoria)
                    <a class="btn btn--tornar" href="{{ route('categories.index') }}">Tornar al llistat</a>
                    <button class="btn btn--enviar" type="submit">Desar canvis</button>
                @else
                    <a class="btn btn--tornar" href="{{ route('categories.index') }}">Tornar enrere</a>
                    <button class="btn btn--enviar" type="submit">Enviar</button>
                @endif
            </div>
        </div>
    </div>
</form>