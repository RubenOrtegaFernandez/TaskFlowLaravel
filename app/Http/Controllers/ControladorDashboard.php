<?php

namespace App\Http\Controllers;

use App\Models\Tasca;
use App\Models\Categoria;
use App\Models\Departament;
use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;

class ControladorDashboard
{
    public function admin(){
        $resultado = redirect('/login')->with('error', 'Logeate como administrador per poder entrar.');

        if (Auth::check() && Auth::user()->rol_tipus === 'admin') {
            $urgents = Tasca::where('prioritat', 'urgent')
                ->whereNotIn('estat', ['fet', 'revisat'])
                ->orderBy('data_final')
                ->get();

            $categories = Categoria::orderBy('nom_cat')->get();
            $departaments = Departament::orderBy('nom')->get();

            $resultado = view('dashboardAdmin', compact('urgents', 'categories', 'departaments'));
        }

        return $resultado;
    }

    public function cap()
    {
        $resultado = redirect('/login')->with('error', 'No tens permisos per entrar al dashboard del cap.');

        if (Auth::check() && Auth::user()->rol_tipus === 'cap') {
            $treballadors = Usuari::where('rol_tipus', 'client')
                ->where('id_dep', Auth::user()->id_dep)
                ->orderBy('nom_usu')
                ->get();

            $tasquesFetes = Tasca::where('id_dep_assignat', Auth::user()->id_dep)
                ->where('estat', 'fet')
                ->orderBy('data_final')
                ->get();

            $urgents = Tasca::where('id_dep_assignat', Auth::user()->id_dep)
                ->where('prioritat', 'urgent')
                ->whereNotIn('estat', ['fet', 'revisat'])
                ->orderBy('data_final')
                ->get();

            $resultado = view('dashboardCap', compact('treballadors', 'tasquesFetes', 'urgents'));
        }

        return $resultado;
    }

    public function treballador(){
        $resultado = redirect()->route('login');

        if (Auth::check() && Auth::user()->rol_tipus === 'client') {
            $tasques = Tasca::where('id_usr_assignat', Auth::id())
                ->orderBy('data_final')
                ->get();

            // Les tasques fetes o revisades queden separades de les que encara requereixen acció.
            $acabades = ['fet', 'revisat'];

            $finalitzades = $tasques->whereIn('estat', $acabades);

            $urgents = $tasques->where('prioritat', 'urgent')->whereNotIn('estat', $acabades);

            $pendents = $tasques->where('prioritat', '!=', 'urgent')->whereNotIn('estat', $acabades);

            $resultado = view('dashboardTreballador', compact('tasques', 'urgents', 'pendents', 'finalitzades'));
        } elseif (Auth::check()) {
            $rutaDashboard = Auth::user()->rol_tipus === 'admin'
                ? 'dashboardadmin.index'
                : 'dashboardcap.index';
            $resultado = redirect()->route($rutaDashboard);
        }

        return $resultado;
    }
}
