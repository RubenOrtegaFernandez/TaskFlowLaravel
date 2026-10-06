<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ControladorRegistre extends Controller
{
    public function register(Request $request){
        $request->validate([
            'nom_usu'     => ['required', 'string', 'max:25'],
            'correu'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contrasenya' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'nom_usu'     => $request->name,
            'correu'    => $request->email,
            'contrasenya' => Hash::make($request->password)
        ]);
        Auth::login($user);
        return redirect()->route('dashboard');
    }
}