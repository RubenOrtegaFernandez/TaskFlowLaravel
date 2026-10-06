<?php

use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn () => view('loginTaskFlow'));

Route::post('/login', [ControladorLogin::class, 'iniciarSessio']);

Route::get('/dashboard.admin', function () {
    return view('dashboardAdmin');
});

Route::get('/dashboard.cap', function () {
    return view('dashboardCap');
});

Route::get('/dashboard.client', function () {
    return view('dashboardClient');
});

Route::get('/contrasenya/oblidada', function () {
    return view('contrasenyaOblidada');
});

Route::get('/registre', function () {
    return view('registreTaskFlow');
});

Route::post('/registreTaskFlow', [ControladorRegistre::class, 'registrarUsuari']);