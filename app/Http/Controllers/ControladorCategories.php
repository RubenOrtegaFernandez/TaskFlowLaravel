<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorCategories{

    public function validar(){
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'client') {

            $esValid = redirect()->route('dashboardtreballador.index');

        } elseif (Auth::user()->rol_tipus === 'cap') {

            $esValid = redirect()->route('dashboardcap.index');

        } else {

            $categories = Categoria::orderBy('nom')->get();

            $esValid = view('categories.llistaCategories', array(
                'categories' => $categories,
            ));
        }

        return $esValid;
    }

    public function create()
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $rutaDashboard = Auth::user()->rol_tipus === 'cap'
                ? 'dashboardcap.index'
                : 'dashboardtreballador.index';
            $resposta = redirect()->route($rutaDashboard);
        } else {
            $resposta = view('categories.creaCategoria');
        }

        return $resposta;
    }

    public function store(Request $request)
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $rutaDashboard = Auth::user()->rol_tipus === 'cap'
                ? 'dashboardcap.index'
                : 'dashboardtreballador.index';
            $resposta = redirect()->route($rutaDashboard);
        } else {
            $dades = $request->validate([
                'nom' => ['required', 'string', 'max:25', 'unique:categories,nom'],
            ]);

            Categoria::create($dades);
            $resposta = redirect()->route('categories.index')->with('status', 'Categoria creada correctament.');
        }

        return $resposta;
    }
}
?>
