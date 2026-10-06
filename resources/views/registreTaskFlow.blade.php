@extends('layouts.guest')

@section('title', 'Registre · TaskFlow')

@section('content')

<main>
    <h1>Crear compte</h1>

    <form method="POST" action="#">
        @csrf

        <label for="nom_usu">Nom</label>
        <input type="text" id="nom_usu" name="nom_usu" required>

        <label for="correu">Correu electrònic</label>
        <input type="email" id="correu" name="correu" required>

        <label for="contrasenya">Contrasenya</label>
        <input type="password" id="contrasenya" name="contrasenya" required>

        <button type="submit">Registrar-se</button>
    </form>

    <a href="/login">Tornar al login</a>
</main>

@endsection