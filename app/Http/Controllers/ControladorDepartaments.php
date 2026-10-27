<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Support\Facades\Auth;

class ControladorDepartaments{

    public function validar(){
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'client') {

            $esValid = redirect()->route('dashboardtreballador.index');

        } elseif (Auth::user()->rol_tipus === 'cap') {

            $esValid = redirect()->route('dashboardcap.index');

        } else {

            $departaments = Departament::orderBy('nom');

            $esValid = view('departament.llistaDepartaments', array(
                'departaments' => $departaments->get(),
            ));
        }

        return $esValid;
    }
}
?>