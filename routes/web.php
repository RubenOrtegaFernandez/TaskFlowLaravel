<?php

use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use App\Http\Controllers\ControladorTasques;
use App\Http\Controllers\ControladorRecuperacio;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('tasca', ControladorTasques::class)->only(['create', 'store']);


Route::get('/dashboard/admin', function () {
    $destino = '/login';
    $mensaje = null;

    if (Auth::check() && Auth::user()->rol_tipus === 'admin') {
        $destino = 'dashboardAdmin';
    } else {
        $mensaje = 'Logeate como admin para poder entrar.';
    }

    if ($destino === 'dashboardAdmin') {
        $resultado = view($destino);
    } else {
        $resultado = redirect($destino)->with('error', $mensaje);
    }

    return $resultado;
})->name('dashboardadmin.index');


Route::get('/dashboard/cap', fn () => view('dashboardCap'))->name('dashboardcap.index');

Route::get('/dashboard/treballador', function () {
    $tasques = \App\Models\Tasca::where('id_usr_assignat', Auth::id())
        ->orderBy('data_final')
        ->get();

    $urgents = $tasques->where('prioritat', 'urgent');
    $pendents = $tasques->where('estat', 'pendent');
    $finalitzades = $tasques->whereIn('estat', ['fet', 'revisat']);

    return view('dashboardTreballador', compact(
        'tasques',
        'urgents',
        'pendents',
        'finalitzades'
    ));
})->name('dashboardtreballador.index');

Route::get('/tasca/llistat-tasques', [ControladorTasques::class, 'index'])->name('tasca.index');

Route::get('/tasca/{tasca}', [ControladorTasques::class, 'show'])->name('tasca.show');

Route::get('/categories', fn () => 'Categories')->name('categoria.index');

Route::get('/tasca/llistat-tasques', [ControladorTasques::class, 'index'])->name('tasca.index');

Route::get('/departaments', fn () => 'Departaments')->name('departament.index');

Route::get('/usuaris', fn () => 'Treballadors')->name('usuari.index');

Route::get('/categories', fn () => 'Categories')->name('categoria.index');

Route::redirect('/', '/login');

Route::get('/login', fn () => view('loginTaskFlow'))->name('login');

Route::post('/login', [ControladorLogin::class, 'iniciarSessio']);

Route::get('/contrasenya/oblidada', [ControladorRecuperacio::class, 'mostrarFormulari'])
    ->name('contrasenya.oblidada');

Route::post('/contrasenya/oblidada', [ControladorRecuperacio::class, 'enviarEnllac'])
    ->name('contrasenya.oblidada.enviar');

Route::get('/restablir-contrasenya/{token}', [ControladorRecuperacio::class, 'mostrarRestabliment'])
    ->name('contrasenya.restablir');

Route::post('/restablir-contrasenya/{token}', [ControladorRecuperacio::class, 'restablir'])
    ->name('contrasenya.actualitzar');

Route::view('/registre', 'registreTaskFlow')->name('registre');

Route::post('/registre', [ControladorRegistre::class, 'registrarUsuari']);