<?php

use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn () => view('loginTaskFlow'));

Route::post('/login', [ControladorLogin::class, 'iniciarSessio']);

Route::get('/admin', function () {
    return 'Pàgina de l\'administrador';
});

Route::get('/cap', function () {
    return 'Pàgina del cap';
});

Route::get('/client', function () {
    return 'Pàgina del client';
});

Route::get('/contrasenya/oblidada', function () {
    return view('contrasenyaOblidada');
});

Route::get('/registre', function () {
    return view('registre');
});

Route::post('/registre', [ControladorRegistre::class, 'registrarUsuari']);