<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorTasques{

    public function create(){
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus != 'admin' && Auth::user()->rol_tipus != 'cap') {
                $esValid = redirect()->route('dashboardtreballador.index');

        } else {

            $usuari = Auth::user();

            $treballadors = Usuari::where('rol_tipus', 'client');
            $departaments = Departament::orderBy('nom');

            // El cap només veu el seu departament i els seus treballadors
            if ($usuari->rol_tipus === 'cap') {
                $treballadors = Usuari::where('rol_tipus', 'client')->where('id_dep', $usuari->id_dep);
                $departaments = Departament::where('id_dep', $usuari->id_dep);
            }

            $categories = array('General', 'Disseny', 'Desenvolupament', 'Administració');

            $esValid = view('tasca.creaTasca', array(
                'rol'          => $usuari->rol_tipus,
                'treballadors' => $treballadors->orderBy('nom_usu')->get(),
                'departaments' => $departaments->orderBy('nom')->get(),
                'categories'   => $categories,
            ));
        }

        return $esValid;
    }

    public function show(Tasca $tasca){
        return view('tasca.veureTasca', compact('tasca'));
    }

    public function edit(Tasca $tasca){
        return view('tasca.editarTasca', compact('tasca'));
    }

    public function delete(Tasca $tasca){
        return view('tasca.esborrarTasca', compact('tasca'));
    }

    public function store(Request $request){
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'client') {

            $esValid = redirect()->route('dashboardtreballador.index');

        } else {

            $dades = request()->validate([
                'nom_tas'         => 'required|max:25',
                'descripcio'      => 'required|max:255',
                'data_inici'      => 'required|date',
                'data_final'      => 'nullable|date|after_or_equal:data_inici',
                'prioritat'       => 'required|in:baixa,mitja,alta,urgent',
                'categoria'       => 'required|max:25',
                'id_dep_assignat' => 'nullable|exists:departaments,id_dep',
                'id_usr_assignat' => 'nullable|exists:usuaris,id_correu',
            ]);

            $dades['id_usr_creador'] = Auth::id();

            // Un cap només pot assignar al seu propi departament
            if (Auth::user()->rol_tipus === 'cap') {
                $dades['id_dep_assignat'] = Auth::user()->id_dep;
            }

            Tasca::create($dades);

            $rutaTornada = Auth::user()->rol_tipus === 'admin' ? 'dashboardadmin.index' : 'dashboardcap.index';

            $esValid = redirect()->route($rutaTornada)
                ->with('status', 'Tasca creada correctament!');
        }

        return $esValid;
    }

    public function validar(){
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'client') {

            $esValid = redirect()->route('dashboardtreballador.index');

        } else {

            $tasques = Tasca::orderBy('data_final');

            if (Auth::user()->rol_tipus === 'cap') {
                $tasques = Tasca::where('id_dep_assignat', Auth::user()->id_dep)->orderBy('data_final');
            }

            $esValid = view('tasca.llistaTasques', array(
                'tasques' => $tasques->get(),
            ));
        }

        return $esValid;
    }

   
    public function marcarFet(Tasca $tasca){
        $resultat = null;

        if (!Auth::check()) {

            $resultat = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'client'
            && $tasca->id_usr_assignat === Auth::id()
            && $tasca->estat !== 'fet'
            && $tasca->estat !== 'revisat') {

            $tasca->update([
                'estat' => 'fet',
                'data_final' => now(),
            ]);

            $resultat = back()->with('status', 'Tasca marcada com a feta.');

        } else {

            $resultat = back()->with('error', 'No pots modificar aquesta tasca.');
        }

        return $resultat;
    }

    public function marcarRevisat(Tasca $tasca){
        $resultat = null;

        if (!Auth::check()) {

            $resultat = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'cap'
            && $tasca->id_dep_assignat === Auth::user()->id_dep
            && $tasca->estat === 'fet') {

            $tasca->update([
                'estat' => 'revisat',
            ]);

            $resultat = back()->with('status', 'Tasca revisada.');

        } else {

            $resultat = back()->with('error', 'No pots revisar aquesta tasca.');
        }

        return $resultat;
    }
}
?>