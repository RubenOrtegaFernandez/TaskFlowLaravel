<?php

use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use App\Http\Controllers\TascaController;
use Illuminate\Support\Facades\Route;

Route::resource('tasca', TascaController::class)->only(['create', 'store']);
Route::get('/tasques', [TascaController::class, 'index'])->name('tasca.index');

Route::get('/departaments', fn () => 'Departaments')->name('departament.index');
Route::get('/usuaris', fn () => 'Treballadors')->name('usuari.index');
Route::get('/categories', fn () => 'Categories')->name('categoria.index');

Route::redirect('/', '/login');

Route::get('/login', fn () => view('loginTaskFlow'))->name('login');

Route::post('/login', [ControladorLogin::class, 'iniciarSessio']);

Route::get('/admin', function () {
    return view('dashboardAdmin');
})->name('admin');

Route::get('/cap', function () {
    return view('dashboardCap');
})->name('cap');

Route::get('/treballador', function () {
    return view('dashboardTreballador');
})->name('treballador');

Route::get('/contrasenya/oblidada', function () {
    return view('contrasenyaOblidada');
});

Route::view('/registre', 'registreTaskFlow')->name('registre');

Route::post('/registre', [ControladorRegistre::class, 'registrarUsuari']);