<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ControladorRegistre extends Controller
{
    public function registrarUsuari(Request $request)
    {
        $request->validate([
            'nom_usu'     => ['required', 'string', 'max:25'],
            'correu'      => ['required', 'string', 'email', 'max:255'],
            'contrasenya' => ['required', 'string', 'min:8'],
        ]);

        $esValid = null;

        $usuariExisteix = Usuari::where('correu', $request->correu)->exists();

        if ($usuariExisteix) {
            $esValid = back()->with('error', 'Aquest correu ja està registrat. Prova de iniciar sessió.');
        } else {
            $usuari = Usuari::create([
                'nom_usu'      => $request->nom_usu,
                'correu'       => $request->correu,
                'contrasenya'  => Hash::make($request->contrasenya),
                'rol_tipus' => 'client',
            ]);

            Auth::login($usuari);
            $request->session()->regenerate();

            $esValid = redirect()->route('login');
        }

        return $esValid;
    }
}