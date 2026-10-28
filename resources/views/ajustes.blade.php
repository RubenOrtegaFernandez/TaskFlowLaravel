@extends('layouts.dashboard')

@section ('title', 'Ajustes · TaskFlow')

@section('header-title', 'AJUSTES')

@section ('sense-nav', 'si')

@section('content')
    <table style="align-self: start;" class="llistat">
        <thead>
            <tr>
                <th><h2>Datos del perfil</h2></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h2>Foto de perfil</h2>

                    @if (session('exit'))
                        <p>{{ session('exit') }}</p>
                    @endif

                    @error('foto')
                        <p>{{ $message }}</p>
                    @enderror

                    <img src="{{ asset($usuari->foto_perfil ?: 'img/default.png') }}" alt="Foto actual" width="96" height="96">

                   <form class="ajustes-form" action="{{ route('ajustes.foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="foto" accept="image/png,image/jpeg,image/webp" required>
                        <button class="btn" type="submit">Canviar foto</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Contrasenya</h2>

                    @if (session('exit_contrasenya'))
                        <p>{{ session('exit_contrasenya') }}</p>
                    @endif

                    @error('contrasenya_actual')
                        <p>{{ $message }}</p>
                    @enderror

                    @error('contrasenya_nova')
                        <p>{{ $message }}</p>
                    @enderror

                    <form class="ajustes-form" action="{{ route('ajustes.contrasenya') }}" method="POST">
                        @csrf
                        <input type="password" name="contrasenya_actual" placeholder="Contrasenya actual" required>
                        <input type="password" name="contrasenya_nova" placeholder="Nova contrasenya" required>
                        <input type="password" name="contrasenya_nova_confirmation" placeholder="Repeteix la nova contrasenya" required>
                        <button class="btn" type="submit">Canviar contrasenya</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
@endsection