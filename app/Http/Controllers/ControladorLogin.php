<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuari;

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

        } elseif (Auth::attempt($credencials)){

            $request->session()->regenerate();
            $usuari = Auth::user();

            if (is_null($usuari->rol_assignat)) {
                $usuari->update([
                    'rol_assignat' => 'client',
                ]);

                $esValid = redirect()->route('client.dashboard')
                    ->with('Benvingut, si no ets un treballador recomanem avisar al teu administrador');
            } else {
                $rutaLogin = match ($usuari->rol_assignat) {
                    'admin'  => 'admin.dashboard',
                    'cap'    => 'cap.dashboard',
                    default  => 'client.dashboard',
                };

                $esValid = redirect()->route($rutaLogin);
            }

        } else {

            $esValid = back()->with('error', 'Contraseña incorrecta.');

        }
        return $esValid;
    }
}