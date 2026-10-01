<?php

use App\Http\Controllers\ControladorLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('loginTaskFlow'));

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