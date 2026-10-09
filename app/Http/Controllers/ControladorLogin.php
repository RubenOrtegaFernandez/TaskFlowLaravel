<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuari;
use Illuminate\Support\Facades\Cookie;

class ControladorLogin extends Controller
{
    public function iniciarSessio(Request $request)
    {
        $credencials = $request->validate([
            'correu' => 'required',
            'contrasenya' => 'required',
        ]);

        $esValid = null;

        $usuariExisteix = Usuari::where('correu', $request->correu)->exists();

        if (!$usuariExisteix){

            $esValid = back()->with('error', 'Aquest usuari no existeix, si us plau, registreu-vos');

        }elseif (Auth::attempt(['correu' => $credencials['correu'],'password' => $credencials['contrasenya']])){

            $request->session()->regenerate();
            $usuari = Auth::user();

            $missatge = $request->cookie('missatge_visto');

            if (!$missatge && is_null($usuari->rol_assignat)) {
                $usuari->update(['rol_tipus' => 'client']);

                Cookie::queue('missatge_vist', 'true', 99999999); // <- Nosecuantos Años que dura la cookie

                return redirect()->route('treballador')
                    ->with('status', 'Benvingut, si no ets un treballador recomanem avisar al teu administrador');
            } else {
                $rutaLogin = match ($usuari->rol_assignat) {
                    'admin'  => 'admin',
                    'cap'    => 'treballador',
                    default  => 'treballador',
                };

                $esValid = redirect()->route($rutaLogin);
            }

        } else {

            $esValid = back()->with('error', 'Contraseña incorrecta.');

        }
        return $esValid;
    }
}