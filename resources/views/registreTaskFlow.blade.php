@extends('layouts.logarse')

@section('title', 'Registre · TaskFlow')

@section('content')

<main>
    <h1>Crear compte</h1>

    @include('components.formulario-registro')

    @if (session('error'))
        <div>
            {{ session('error') }}
        </div>
    @endif
</main>

@endsection