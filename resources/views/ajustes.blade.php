@extends('layouts.dashboard')

@section('header-title', 'Ajustes')

@section('content')
    <h2>Foto de perfil</h2>

    @if (session('exit'))
        <p>{{ session('exit') }}</p>
    @endif

    @error('foto')
        <p>{{ $message }}</p>
    @enderror

    <img src="{{ asset($usuari->foto_perfil ?: 'img/default.png') }}" alt="Foto actual" width="96" height="96">

    <form action="{{ route('ajustes.foto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="foto" accept="image/png,image/jpeg,image/webp" required>
        <button type="submit">Canviar foto</button>
    </form>
@endsection