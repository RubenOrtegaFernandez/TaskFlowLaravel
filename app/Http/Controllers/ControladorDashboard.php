<?php

namespace App\Http\Controllers;

use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;

class ControladorDashboard
{
    public function admin()
    {
        $resultado = redirect('/login')->with('error', 'Logeate como administrador per poder entrar.');

        if (Auth::check() && Auth::user()->rol_tipus === 'admin') {
            $resultado = view('dashboardAdmin');
        }

        return $resultado;
    }

    public function cap()
    {
        $resultado = redirect('/login')->with('error', 'Logeate como cap per poder entrar.');

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

    public function treballador()
    {
        $tasques = Tasca::where('id_usr_assignat', Auth::id())
            ->orderBy('data_final')
            ->get();

        $urgents = $tasques->where('prioritat', 'urgent')->where('estat', '!=', 'revisat');
        $noUrgents = $tasques->where('prioritat', '!=', 'urgent');
        $pendents = $noUrgents->where('estat', 'pendent');
        $finalitzades = $noUrgents->whereIn('estat', ['fet', 'revisat']);

        return view('dashboardTreballador', compact(
            'tasques',
            'urgents',
            'pendents',
            'finalitzades'
        ));
    }
}
