<?php

namespace App\Http\Controllers;

use App\Models\Tasca;
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

            $categories = Tasca::select('categoria')
                ->distinct()
                ->orderBy('categoria')
                ->pluck('categoria');

            $esValid = view('categories.llistaCategories', array(
                'categories' => $categories,
            ));
        }

        return $esValid;
    }
}
?>