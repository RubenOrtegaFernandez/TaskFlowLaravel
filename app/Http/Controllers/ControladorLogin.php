<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorLogin extends Controller
{
    public function iniciarSessio(Request $request)
    {
        $credencials = $request->validate([
            'correu' => 'required',
            'contrasenya' => 'required',
        ]);

        $ruta = '/login';

        if (Auth::attempt([
            'correu' => $credencials['correu'],
            'password' => $credencials['contrasenya'],
        ])) {
            $request->session()->regenerate();

            $usuari = Auth::user();

            if ($usuari->rol_tipus == 'admin') {
                $ruta = '/admin';
            } elseif ($usuari->rol_tipus == 'cap') {
                $ruta = '/cap';
            } else {
                $ruta = '/client';
            }
        }

        return redirect($ruta);
    }
}