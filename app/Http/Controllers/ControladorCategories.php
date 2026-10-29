<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorCategories
{
    public function validar()
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } else {
            $categories = Categoria::orderBy('nom_cat')->get();
            $esValid = view('categories.llistaCategories', compact('categories'));
        }

        return $esValid;
    }

    public function create()
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $esValid = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } else {
            $esValid = view('categories.creaCategoria');
        }

        return $esValid;
    }

    public function store(Request $request)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $esValid = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } else {
            $dades = $request->validate([
                'nom' => ['required', 'string', 'max:25', 'unique:categories,nom_cat'],
            ]);

            Categoria::create([
                'nom_cat' => $dades['nom'],
            ]);

            $esValid = redirect()->route('categories.index')->with('status', 'Categoria creada correctament.');
        }

        return $esValid;
    }
}
?>
