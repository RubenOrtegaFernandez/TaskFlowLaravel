<?php

namespace App\Http\Controllers;

use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;

class ControladorDashboard
{
    public function admin()
    {
        $resultado = redirect('/login');

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

            $resultado = view('dashboardCap', compact('treballadors'));
        }

        return $resultado;
    }

    public function treballador()
    {
        $tasques = Tasca::where('id_usr_assignat', Auth::id())
            ->orderBy('data_final')
            ->get();

        $urgents = $tasques->where('prioritat', 'urgent');
        $pendents = $tasques->where('estat', 'pendent');
        $finalitzades = $tasques->whereIn('estat', ['fet', 'revisat']);

        return view('dashboardTreballador', compact(
            'tasques',
            'urgents',
            'pendents',
            'finalitzades'
        ));
    }
}
