@extends('layouts.dashboard')

@section('title', 'Ajustes · TaskFlow')
@section('header-title', 'AJUSTES')
@section('sense-nav', 'si')

@section('content')
    <section class="admin-panel ajustes-panel">
        <div class="ajustes-panel__capcalera">
            <h2 class="admin-panel__title">Configuració del perfil</h2>
            <a class="btn btn--tornar" href="{{ auth()->user()->rol_tipus === 'cap' ? route('dashboardcap.index') : (auth()->user()->rol_tipus === 'client' ? route('dashboardtreballador.index') : route('dashboardadmin.index')) }}">Tornar al dashboard</a>
        </div>

        <table class="llistat ajustes__taula">
            <tbody>
                <tr>
                    <td>
                        <section class="ajustes__seccio">
                            <h3>Foto de perfil</h3>

                            @if (session('exit'))
                                <p class="ajustes__missatge" role="status">{{ session('exit') }}</p>
                            @endif

                            @error('foto')
                                <p class="ajustes__error" role="alert">{{ $message }}</p>
                            @enderror

                            <div class="ajustes__foto">
                                <img src="{{ asset($usuari->foto_perfil ?: 'img/default.png') }}" alt="Foto de perfil de {{ $usuari->nom_usu }}">
                                <form class="ajustes-form" action="{{ route('ajustes.foto') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="foto-perfil">Selecciona una imatge nova</label>
                                    <input id="foto-perfil" type="file" name="foto" accept="image/png,image/jpeg,image/webp" required>
                                    <button class="btn" type="submit">Canviar foto</button>
                                </form>
                            </div>
                        </section>
                    </td>
                </tr>
                <tr>
                    <td>
                        <section class="ajustes__seccio">
                            <h3>Contrasenya</h3>

                            @if (session('exit_contrasenya'))
                                <p class="ajustes__missatge" role="status">{{ session('exit_contrasenya') }}</p>
                            @endif

                            @error('contrasenya_actual')
                                <p class="ajustes__error" role="alert">{{ $message }}</p>
                            @enderror

                            @error('contrasenya_nova')
                                <p class="ajustes__error" role="alert">{{ $message }}</p>
                            @enderror

                            <form class="ajustes-form ajustes-form--contrasenya" action="{{ route('ajustes.contrasenya') }}" method="POST">
                                @csrf
                                <label for="contrasenya-actual">Contrasenya actual</label>
                                <div class="ajustes-form__password">
                                    <input id="contrasenya-actual" type="password" name="contrasenya_actual" autocomplete="current-password" required>
                                    @include('components.boto-ull-contrasenya', ['id' => 'contrasenya-actual'])
                                </div>
                                <label for="contrasenya-nova">Nova contrasenya</label>
                                <div class="ajustes-form__password">
                                    <input id="contrasenya-nova" type="password" name="contrasenya_nova" autocomplete="new-password" required>
                                    @include('components.boto-ull-contrasenya', ['id' => 'contrasenya-nova'])
                                </div>
                                <label for="contrasenya-confirmacio">Repeteix la nova contrasenya</label>
                                <div class="ajustes-form__password">
                                    <input id="contrasenya-confirmacio" type="password" name="contrasenya_nova_confirmation" autocomplete="new-password" required>
                                    @include('components.boto-ull-contrasenya', ['id' => 'contrasenya-confirmacio'])
                                </div>
                                <button class="btn" type="submit">Canviar contrasenya</button>
                            </form>
                        </section>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection
