<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ControladorRecuperacio
{
    public function mostrarFormulari()
    {
        $esValid = view('contrasenyaOblidada');

        return $esValid;
    }

    public function enviarEnllac(Request $request)
    {
        $request->validate([
            'correu' => ['required', 'email'],
        ]);

        $usuari = Usuari::where('correu', $request->correu)->first();

        if ($usuari) {
            $token = Password::broker()->createToken($usuari);

            $enllac = url('/restablir-contrasenya/' . $token)
                . '?correu=' . $usuari->correu;

            $missatge = 'Recuperació de contrasenya: ' . $enllac;

            Mail::raw($missatge, function ($mail) use ($usuari) {
                $mail->to($usuari->correu);
                $mail->subject('Recuperació de contrasenya');
            });
        }

        return back()->with(
            'status',
            'Si el correu existeix, rebràs les instruccions de recuperació.'
        );
    }

    public function mostrarRestabliment($token)
    {
        $correu = request('correu');
        $usuari = Usuari::where('correu', $correu)->first();

        if (!$usuari || !Password::broker()->tokenExists($usuari, $token)) {
            $vista = redirect()->route('contrasenya.oblidada')
                ->with('error', 'L’enllaç de recuperació no és vàlid o ha caducat.');
        } else {
            $vista = view('restablirContrasenya');
        }

        return $vista;
    }

    public function restablir(Request $request, $token)
    {
        $request->validate([
            'correu' => ['required', 'email'],
            'contrasenya' => ['required', 'min:8', 'confirmed'],
        ]);

        $usuari = Usuari::where('correu', $request->correu)->first();

        if ($usuari && Password::broker()->tokenExists($usuari, $token)) {
            $usuari->contrasenya = Hash::make($request->contrasenya);
            $usuari->save();

            Password::broker()->deleteToken($usuari);

            $vista = redirect()->route('login')
                ->with('status', 'La contrasenya s’ha canviat correctament.');
        } else {
            $vista = back()->withErrors([
                'correu' => 'L’enllaç de recuperació no és vàlid o ha caducat.',
            ]);
        }

        return $vista;
    }
}