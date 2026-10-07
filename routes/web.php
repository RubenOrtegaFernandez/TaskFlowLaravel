<?php

use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn () => view('loginTaskFlow'))->name('login');

Route::post('/login', [ControladorLogin::class, 'iniciarSessio']);

Route::get('/dashboard.admin', function () {
    return view('dashboardAdmin');
})->name('admin.dashboard');

Route::get('/admin', function () {
    return view('dashboardAdmin');
})->name('admin');

Route::get('/dashboard.cap', function () {
    return view('dashboardCap');
})->name('cap.dashboard');

Route::get('/cap', function () {
    return view('dashboardCap');
})->name('cap');

Route::get('/dashboard.client', function () {
    return view('dashboardClient');
})->name('client.dashboard');

Route::get('/treballador', function () {
    return view('dashboardTreballador');
})->name('treballador');

Route::get('/contrasenya/oblidada', function () {
    return view('contrasenyaOblidada');
});

Route::view('/registre', 'registreTaskFlow')->name('registre');

Route::post('/registre', [ControladorRegistre::class, 'registrarUsuari']);
