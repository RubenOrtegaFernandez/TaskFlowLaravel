<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorRegistre extends Controller
{
    public function registrarUsuari(Request $request)
    {
        /*

        $credencials = $request->validate([
            'correu' => 'required',
            'contrasenya' => 'required',
        ]);

        $ruta = '/registre';

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
        
        */
        return redirect("/login");

    }
}