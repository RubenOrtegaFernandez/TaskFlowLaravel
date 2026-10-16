<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuari;
use Illuminate\Support\Facades\Cookie;

class ControladorLogin
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

            $esValid = back()->withErrors(['correu' => 'Aquest usuari no existeix, si us plau, registreu-vos'])->withInput();

        }elseif (Auth::attempt(['correu' => $credencials['correu'],'password' => $credencials['contrasenya']])){

            $request->session()->regenerate();
            $usuari = Auth::user();

            $missatge = $request->cookie('missatge_vist');

            if (!$missatge && $usuari->rol_tipus === 'client') {

                Cookie::queue('missatge_vist', 'true', 99999999); // <- Nosecuantos Años que dura la cookie

                $esValid = redirect()->route('treballador')
                    ->with('status', 'Benvingut, si no ets un treballador recomanem avisar al teu administrador');
            } else {
                $rutaLogin = match ($usuari->rol_tipus) {
                'admin' => 'dashboardadmin.index',
                'cap' => 'dashboardcap.index',
                default => 'dashboardtreballador.index',
            };

            $esValid = redirect()->route($rutaLogin);
            }

        } else {

           $esValid = back()->withErrors(['contrasenya' => 'Contrasenya incorrecta.'])->withInput();

        }
        return $esValid;
    }
}