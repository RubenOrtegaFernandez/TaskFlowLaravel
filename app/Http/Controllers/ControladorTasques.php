<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Categoria;
use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControladorTasques{

    public function create(Request $request){
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus != 'admin' && Auth::user()->rol_tipus != 'cap') {
                $esValid = redirect()->route('dashboardtreballador.index');

        } else {

            $usuari = Auth::user();

            $departaments = Departament::with(['treballadors' => fn ($q) => $q->orderBy('nom_usu')])->orderBy('nom');

            // El cap només veu el seu departament i els seus treballadors
            if ($usuari->rol_tipus === 'cap') {
                $departaments->where('id_dep', $usuari->id_dep);
            }

            $categories = Categoria::orderBy('nom_cat')->pluck('nom_cat')->all();

            $prioritatFixa = $request->query('prioritat') === 'urgent';
            $origen = $request->query('origen') === 'tasques' ? 'tasques' : 'dashboard';

            $esValid = view('tasca.creaTasca', array(
                'rol'          => $usuari->rol_tipus,
                'departaments' => $departaments->orderBy('nom')->get(),
                'categories'   => $categories,
                'prioritatFixa' => $prioritatFixa,
                'origen' => $origen,
                'tasca' => null,
            ));
        }

        return $esValid;
    }

    public function show(Tasca $tasca){
        return view('tasca.veureTasca', compact('tasca'));
    }

    public function edit(Tasca $tasca){
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap' && $tasca->id_dep_assignat != Auth::user()->id_dep) {
            $esValid = redirect()->route('dashboardcap.index');
        } else {
            $usuari = Auth::user();
            $departaments = Departament::with(['treballadors' => fn ($q) => $q->orderBy('nom_usu')])->orderBy('nom');

            if ($usuari->rol_tipus === 'cap') {
                $departaments->where('id_dep', $usuari->id_dep);
            }

            $categories = Categoria::orderBy('nom_cat')->pluck('nom_cat')->all();

            $esValid = view('tasca.editarTasca', array(
                'tasca' => $tasca,
                'departaments' => $departaments->orderBy('nom')->get(),
                'categories' => $categories,
            ));
        }

        return $esValid;
    }

    public function delete(Tasca $tasca){
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap' && $tasca->id_dep_assignat != Auth::user()->id_dep) {
            $esValid = redirect()->route('dashboardcap.index');
        } else {
            $esValid = view('tasca.esborrarTasca', compact('tasca'));
        }

        return $esValid;
    }

    public function destroy(Tasca $tasca){
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap' && $tasca->id_dep_assignat != Auth::user()->id_dep) {
            $esValid = redirect()->route('dashboardcap.index');
        } else {
            $tasca->delete();
            $esValid = redirect()->route('tasca.index')->with('status', 'Tasca esborrada correctament.');
        }

        return $esValid;
    }

    public function store(Request $request){
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'client') {

            $esValid = redirect()->route('dashboardtreballador.index');

        } else {

            $prioritatFixa = $request->query('prioritat') === 'urgent';

            $dades = $request->validate([
                'nom_tas'         => 'required|max:25',
                'descripcio'      => 'required|max:255',
                'data_inici'      => 'required|date',
                'data_final'      => 'nullable|date|after_or_equal:data_inici',
                'prioritat'       => $prioritatFixa ? 'prohibited' : 'required|in:baixa,mitja,alta,urgent',
                'categoria'       => 'required|exists:categories,nom_cat',
                'id_dep_assignat' => 'nullable|exists:departaments,id_dep',
                'id_usr_assignat' => 'nullable|exists:usuaris,id_correu',
            ]);

            $dades['id_usr_creador'] = Auth::id();

            if ($prioritatFixa) {
                $dades['prioritat'] = 'urgent';
            }

            // Un cap només pot assignar al seu propi departament
            if (Auth::user()->rol_tipus === 'cap') {
                $dades['id_dep_assignat'] = Auth::user()->id_dep;
            }

            Tasca::create($dades);

            $origen = $request->query('origen') === 'tasques' ? 'tasques' : 'dashboard';
            $rutaTornada = $origen === 'tasques'
                ? 'tasca.index'
                : (Auth::user()->rol_tipus === 'admin' ? 'dashboardadmin.index' : 'dashboardcap.index');

            $esValid = redirect()->route($rutaTornada)
                ->with('status', 'Tasca creada correctament!');
        }

        return $esValid;
    }

    public function update(Request $request, Tasca $tasca){
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap' && $tasca->id_dep_assignat !== Auth::user()->id_dep) {
            $esValid = redirect()->route('dashboardcap.index');
        } else {
            $dades = $request->validate([
                'nom_tas'         => 'required|max:25',
                'descripcio'      => 'required|max:255',
                'data_inici'      => 'required|date',
                'data_final'      => 'nullable|date|after_or_equal:data_inici',
                'prioritat'       => 'required|in:baixa,mitja,alta,urgent',
                'categoria'       => 'required|exists:categories,nom_cat',
                'id_dep_assignat' => 'nullable|exists:departaments,id_dep',
                'id_usr_assignat' => 'nullable|exists:usuaris,id_correu',
            ]);

            if (Auth::user()->rol_tipus === 'cap') {
                $dades['id_dep_assignat'] = Auth::user()->id_dep;
            }

            $tasca->update($dades);
            $esValid = redirect()->route('tasca.index')->with('status', 'Tasca modificada correctament.');
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
