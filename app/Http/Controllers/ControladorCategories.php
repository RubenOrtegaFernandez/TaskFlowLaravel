<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            $esValid = view('components.categories.llistaCategories', compact('categories'));
        }

        return $esValid;
    }

    public function create()
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (!in_array(Auth::user()->rol_tipus, ['admin', 'cap'], true)) {
            $esValid = redirect()->route('dashboardtreballador.index');
        } else {
            $esValid = view('components.categories.creaCategoria');
        }

        return $esValid;
    }

    public function store(Request $request)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (!in_array(Auth::user()->rol_tipus, ['admin', 'cap'], true)) {
            $esValid = redirect()->route('dashboardtreballador.index');
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

    public function edit(Categoria $categoria){
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (!in_array(Auth::user()->rol_tipus, ['admin', 'cap'], true)) {
            $esValid = redirect()->route('dashboardtreballador.index');
        } else {
            $esValid = view('components.categories.editarCategoria', compact('categoria'));
        }

        return $esValid;
    }

    public function delete(Categoria $categoria){
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (!in_array(Auth::user()->rol_tipus, ['admin', 'cap'], true)) {
            $esValid = redirect()->route('dashboardtreballador.index');
        } else {
            $categoria->loadCount('tasques');
            $esValid = view('components.categories.esborrarCategoria', compact('categoria'));
        }

        return $esValid;
    }

    public function update(Request $request, Categoria $categoria){
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (!in_array(Auth::user()->rol_tipus, ['admin', 'cap'], true)) {
            $esValid = redirect()->route('dashboardtreballador.index');
        } else {
            $dades = $request->validate([
                'nom' => ['required', 'string', 'max:25', Rule::unique('categories', 'nom_cat')->ignore($categoria->id_categoria, 'id_categoria')],
            ]);

            // Les tasques guarden el nom de la categoria com a text, així que cal actualitzar-les amb el canvi.
            DB::transaction(function () use ($categoria, $dades) {
                $categoria->tasques()->update(['categoria' => $dades['nom']]);
                $categoria->update(['nom_cat' => $dades['nom']]);
            });

            $esValid = redirect()->route('categories.index')->with('status', 'Categoria actualitzada correctament.');
        }

        return $esValid;
    }

    public function destroy(Categoria $categoria){
        $esValid = null;

        // Les tasques guarden el nom de la categoria com a text, no com a clau forana.
        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (!in_array(Auth::user()->rol_tipus, ['admin', 'cap'], true)) {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif ($categoria->tasques()->exists()) {
            $esValid = redirect()->route('categories.index')
                ->with('error', 'No es pot eliminar: hi ha tasques que usen aquesta categoria.');
        } else {
            try {
                $categoria->delete();
                $esValid = redirect()->route('categories.index')->with('status', 'Categoria eliminada correctament.');
            } catch (QueryException) {
                $esValid = redirect()->route('categories.index')->with('error', 'No es pot eliminar: hi ha tasques que usen aquesta categoria.');
            }
        }

        return $esValid;
    }
}
?>
