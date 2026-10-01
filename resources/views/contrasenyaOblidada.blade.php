@extends('layouts.guest')

@section('title', 'Recuperar contrasenya · TaskFlow')

@section('content')

<main>
    <h1>Recuperar contrasenya</h1>

    <p>Introdueix el teu correu electrònic i t'enviarem les instruccions per recuperar la contrasenya.</p>

    <form method="POST" action="#">
        @csrf

        <label for="correu">Correu electrònic</label>
        <input type="email" id="correu" name="correu" required>

        <button type="submit">Enviar</button>
    </form>

    <a href="/">Tornar al login</a>
</main>

@endsection