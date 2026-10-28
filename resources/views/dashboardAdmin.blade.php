@extends('layouts.dashboard')

@section('title', 'Admin · TaskFlow')

@section('content')
    @if (session('status'))
        <div class="missatge-popup" id="missatgePopup" role="alert" data-timeout="10000">
            <p class="admin-panel__description">{{ session('status') }}</p>
            <button type="button" class="missatge-popup__close" id="missatgePopupClose" aria-label="Cerrar">&times;</button>
        </div>
    @endif

    @include('components.panel-dashboard')
@endsection