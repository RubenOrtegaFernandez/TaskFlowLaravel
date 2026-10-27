<?php
//php artisan serve --host=0.0.0.0
//hacerlo para que quien quiera verlo pueda desde cualquier ordenador
use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use App\Http\Controllers\ControladorTasques;
use App\Http\Controllers\ControladorDepartaments;
use App\Http\Controllers\ControladorRecuperacio;
use App\Http\Controllers\ControladorPerfil;
use App\Http\Controllers\ControladorDashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('tasca', ControladorTasques::class)->only(['create', 'store']);

Route::get('/dashboard/admin', [ControladorDashboard::class, 'admin'])->name('dashboardadmin.index');

Route::get('/dashboard/cap', [ControladorDashboard::class, 'cap'])->name('dashboardcap.index');

Route::get('/dashboard/treballador', [ControladorDashboard::class, 'treballador'])->name('dashboardtreballador.index');

Route::get('/tasca/llistat-tasques', [ControladorTasques::class, 'validar'])->name('tasca.index');

Route::get('/tasca/{tasca}', [ControladorTasques::class, 'show'])->whereNumber('tasca')->name('tasca.show');

Route::get('/tasca/{tasca}/editar', [ControladorTasques::class, 'edit'])->whereNumber('tasca')->name('tasca.edit');

Route::get('/tasca/{tasca}/esborrar', [ControladorTasques::class, 'delete'])->whereNumber('tasca')->name('tasca.delete');

Route::get('/departaments', [ControladorDepartaments::class, 'validar'])->name('departament.index');

Route::get('/categories', [ControladorDepartaments::class, 'validar'])->name('categories.index');

Route::get('/treballadors', [ControladorDepartaments::class, 'validar'])->name('treballadors.index');

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

Route::get('/ajustes', [ControladorPerfil::class, 'index'])->name('ajustes');

Route::post('/ajustes/foto', [ControladorPerfil::class, 'actualitzarFoto'])->name('ajustes.foto');

Route::post('/ajustes/contrasenya', [ControladorPerfil::class, 'actualitzarContrasenya'])->name('ajustes.contrasenya');

Route::view('/registre', 'registreTaskFlow')->name('registre');

Route::post('/registre', [ControladorRegistre::class, 'registrarUsuari']);

Route::post('/tasca/{tasca}/fet', [ControladorTasques::class, 'marcarFet'])->name('tasca.fet');
Route::post('/tasca/{tasca}/revisar', [ControladorTasques::class, 'marcarRevisat'])->name('tasca.revisar');
