<?php

namespace App\Http\Controllers;

use App\Mail\RecuperarContrasenyaMail;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ControladorRecuperacio
{
    public function mostrarFormulari()
    {
        return view('contrasenyaOblidada');
    }

    public function enviarEnllac(Request $request)
    {
        $request->validate(['correu' => ['required', 'email']]);

        $usuari = Usuari::where('correu', $request->correu)->first();

        if ($usuari) {
            // El token queda associat al compte i només s'envia si l'adreça existeix.
            $token = Password::broker()->createToken($usuari);
            $enllac = url('/restablir-contrasenya/' . $token) . '?correu=' . urlencode($usuari->correu);

            Mail::to($usuari->correu)->send(new RecuperarContrasenyaMail($enllac));
        }

        return back()->with('status', 'Si el correu existeix, rebràs les instruccions de recuperació.');
    }

    public function mostrarRestabliment(Request $request, $token)
    {
        if ($this->tokenValid($request->query('correu'), $token)) {
            $resposta = view('restablirContrasenya');
        } else {
            $resposta = redirect()->route('contrasenya.oblidada')
                ->with('error', 'L’enllaç de recuperació no és vàlid o ha caducat.');
        }

        return $resposta;
    }

    public function restablir(Request $request, $token)
    {
        $request->validate([
            'correu' => ['required', 'email'],
            'contrasenya' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($this->tokenValid($request->correu, $token)) {
            $usuari = Usuari::where('correu', $request->correu)->first();
            $usuari->contrasenya = Hash::make($request->contrasenya);
            $usuari->save();

            // En esborrar el token, l'enllaç deixa de poder-se reutilitzar.
            Password::broker()->deleteToken($usuari);

            $resposta = redirect()->route('login')
                ->with('status', 'La contrasenya s’ha canviat correctament.');
        } else {
            $resposta = back()->withErrors([
                'correu' => 'L’enllaç de recuperació no és vàlid o ha caducat.',
            ]);
        }

        return $resposta;
    }

    private function tokenValid($correu, $token)
    {
        $usuari = Usuari::where('correu', $correu)->first();

        return $usuari && Password::broker()->tokenExists($usuari, $token);
    }
}
