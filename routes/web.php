<?php
/*php artisan serve --host=0.0.0.0
hacerlo para que quien quiera verlo pueda desde cualquier ordenador
*/
use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistre;
use App\Http\Controllers\ControladorTasques;
use App\Http\Controllers\ControladorCategories;
use App\Http\Controllers\ControladorDepartaments;
use App\Http\Controllers\ControladorRecuperacio;
use App\Http\Controllers\ControladorPerfil;
use App\Http\Controllers\ControladorDashboard;
use App\Http\Controllers\ControladorUsuaris;
use App\Http\Controllers\ControladorExports;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('tasca', ControladorTasques::class)->only(['create', 'store']);

Route::get('/dashboard/admin', [ControladorDashboard::class, 'admin'])->name('dashboardadmin.index');

Route::get('/dashboard/cap', [ControladorDashboard::class, 'cap'])->name('dashboardcap.index');

Route::get('/dashboard/treballador', [ControladorDashboard::class, 'treballador'])->name('dashboardtreballador.index');

Route::get('/tasca/llistat-tasques', [ControladorTasques::class, 'validar'])->name('tasca.index');

Route::get('/tasca/{tasca}', [ControladorTasques::class, 'show'])->whereNumber('tasca')->name('tasca.show');

Route::get('/tasca/{tasca}/editar', [ControladorTasques::class, 'edit'])->whereNumber('tasca')->name('tasca.edit');

Route::post('/tasca/{tasca}/actualitzar', [ControladorTasques::class, 'update'])->whereNumber('tasca')->name('tasca.update');

Route::get('/tasca/{tasca}/esborrar', [ControladorTasques::class, 'delete'])->whereNumber('tasca')->name('tasca.delete');

Route::post('/tasca/{tasca}/esborrar', [ControladorTasques::class, 'destroy'])->whereNumber('tasca')->name('tasca.destroy');

Route::post('/tasca/{tasca}/activar-desactivar', [ControladorTasques::class, 'canviarActiva'])->whereNumber('tasca')->name('tasca.canviar-activa');

Route::get('/tasques/exportar', [ControladorExports::class, 'tasques'])->name('tasques.exportar')->middleware('auth');

Route::get('/departaments', [ControladorDepartaments::class, 'validar'])->name('departament.index');

Route::get('/departament/create', [ControladorDepartaments::class, 'create'])->name('departament.create');

Route::post('/departament', [ControladorDepartaments::class, 'store'])->name('departament.store');

Route::get('/departament/{departament}/editar', [ControladorDepartaments::class, 'edit'])->whereNumber('departament')->name('departament.edit');

Route::post('/departament/{departament}/actualitzar', [ControladorDepartaments::class, 'update'])->whereNumber('departament')->name('departament.update');

Route::get('/departament/{departament}/esborrar', [ControladorDepartaments::class, 'delete'])->whereNumber('departament')->name('departament.delete');

Route::post('/departament/{departament}/esborrar', [ControladorDepartaments::class, 'destroy'])->whereNumber('departament')->name('departament.destroy');

Route::get('/departaments/{departament}', [ControladorDepartaments::class, 'show'])->whereNumber('departament')->name('departament.show');

Route::get('/categories', [ControladorCategories::class, 'validar'])->name('categories.index');

Route::get('/categoria/create', [ControladorCategories::class, 'create'])->name('categories.create');

Route::post('/categoria', [ControladorCategories::class, 'store'])->name('categories.store');

Route::get('/categoria/{categoria}/editar', [ControladorCategories::class, 'edit'])->whereNumber('categoria')->name('categories.edit');

Route::post('/categoria/{categoria}/actualitzar', [ControladorCategories::class, 'update'])->whereNumber('categoria')->name('categories.update');

Route::get('/categoria/{categoria}/esborrar', [ControladorCategories::class, 'delete'])->whereNumber('categoria')->name('categories.delete');

Route::post('/categoria/{categoria}/esborrar', [ControladorCategories::class, 'destroy'])->whereNumber('categoria')->name('categories.destroy');

Route::get('/treballadors', fn () => 'Treballadors')->name('treballadors.index');

Route::get('/usuaris', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return Auth::user()->rol_tipus === 'cap'
        ? redirect()->route('cap.usuaris.index')
        : redirect()->route('usuari.index');
});

Route::prefix('admin/usuaris')->name('usuari.')->group(function () {
    Route::get('/', [ControladorUsuaris::class, 'index'])->name('index');
    Route::get('/{usuari}/editar', [ControladorUsuaris::class, 'edit'])->whereNumber('usuari')->name('edit');
    Route::post('/{usuari}/actualitzar', [ControladorUsuaris::class, 'update'])->whereNumber('usuari')->name('update');
    Route::get('/{usuari}/esborrar', [ControladorUsuaris::class, 'delete'])->whereNumber('usuari')->name('delete');
    Route::post('/{usuari}/esborrar', [ControladorUsuaris::class, 'destroy'])->whereNumber('usuari')->name('destroy');
    Route::get('/{usuari}', [ControladorUsuaris::class, 'show'])->whereNumber('usuari')->name('show');
});

Route::prefix('cap')->name('cap.')->group(function () {
    Route::get('/usuaris', [ControladorUsuaris::class, 'index'])->name('usuaris.index');
    Route::get('/usuaris/{usuari}/editar', [ControladorUsuaris::class, 'edit'])->whereNumber('usuari')->name('usuaris.edit');
    Route::post('/usuaris/{usuari}/actualitzar', [ControladorUsuaris::class, 'update'])->whereNumber('usuari')->name('usuaris.update');
    Route::get('/usuaris/{usuari}/esborrar', [ControladorUsuaris::class, 'delete'])->whereNumber('usuari')->name('usuaris.delete');
    Route::post('/usuaris/{usuari}/esborrar', [ControladorUsuaris::class, 'destroy'])->whereNumber('usuari')->name('usuaris.destroy');
    Route::get('/usuaris/{usuari}', [ControladorUsuaris::class, 'show'])->whereNumber('usuari')->name('usuaris.show');
});

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

Route::post('/ajustes/logout', [ControladorPerfil::class, 'tancarSessio'])
    ->middleware('auth')
    ->name('ajustes.logout');

Route::view('/registre', 'registreTaskFlow')->name('registre');

Route::post('/registre', [ControladorRegistre::class, 'registrarUsuari']);

Route::get('/tasques/export', [ControladorExports::class, 'tasques'])->name('tasques.export');

Route::post('/tasca/{tasca}/fet', [ControladorTasques::class, 'marcarFet'])->name('tasca.fet');
Route::post('/tasca/{tasca}/revisar', [ControladorTasques::class, 'marcarRevisat'])->name('tasca.revisar');
