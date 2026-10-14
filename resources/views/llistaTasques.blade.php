@extends('layouts.dashboard')

@section('title', 'Tasques · TaskFlow')

@section('header-title', 'Tasques')

@section('content')
<section class="admin-panel llista-tasques">
    <h2 class="admin-panel__title">Llistat de tasques</h2>

    @if (session('status'))
        <p class="admin-panel__description">{{ session('status') }}</p>
    @endif

    @include('components.taula-tasques')
</section>
@endsection