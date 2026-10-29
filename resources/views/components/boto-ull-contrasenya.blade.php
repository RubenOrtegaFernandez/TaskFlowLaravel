<button
    class="password-toggle {{ $class ?? '' }}"
    type="button"
    data-password-toggle
    aria-label="Mostrar contrasenya"
    aria-controls="{{ $id }}"
    aria-pressed="false"
>
    <svg class="password-toggle__icon" aria-hidden="true">
        <use href="#icon-ull-tancat" xlink:href="#icon-ull-tancat"></use>
    </svg>
</button>
