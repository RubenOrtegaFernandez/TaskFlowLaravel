<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ControladorPerfil
{
    public function index()
    {
        return view('ajustes', [
            'usuari' => Auth::user(),
        ]);
    }

        public function actualitzarFoto(Request $request){
        $request->validate([
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $usuari = Auth::user();
        $fitxer = $request->file('foto');

        // 1. Guardar la nueva en public/img/perfils
        $nom = Str::uuid() . '.' . $fitxer->extension();
        $fitxer->move(public_path('img/perfils'), $nom);

        // 2. Borrar la anterior solo si era una foto personalizada
        $anterior = $usuari->foto_perfil;

        if ($anterior
            && str_starts_with($anterior, 'img/perfils/')
            && !str_contains($anterior, '..')) {

            $rutaAnterior = public_path($anterior);

            if (file_exists($rutaAnterior)) {
                unlink($rutaAnterior);
            }
        }

        // 3. Guardar la nueva ruta en la BD
        $usuari->foto_perfil = 'img/perfils/' . $nom;
        $usuari->save();

        return redirect()->route('ajustes')->with('exit', 'Foto actualitzada.');
    }
}