<?php

namespace App\Http\Controllers;

use App\Models\Categories;
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

            $categories = Categoria::orderBy('nom');

            $esValid = view('categories.llistaCategories', array(
                'departaments' => $categories->get(),
            ));
        }

        return $esValid;
    }
}
?>