<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TascaController extends Controller
{

    public function create()
    {
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus != 'admin' && Auth::user()->rol_tipus != 'cap') {
                $esValid = redirect()->route('treballador');

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


    public function store(Request $request)
    {
        $esValid = null;

        if (!Auth::check()) {

            $esValid = redirect()->route('login');

        } elseif (Auth::user()->rol_tipus === 'client') {

            $esValid = redirect()->route('treballador');

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

            $rutaTornada = Auth::user()->rol_tipus === 'admin' ? 'admin' : 'cap';

            $esValid = redirect()->route($rutaTornada)
                ->with('status', 'Tasca creada correctament!');
        }

        return $esValid;
    }

    public function index()
    {
    $esValid = null;

    if (!Auth::check()) {

        $esValid = redirect()->route('login');

    } elseif (Auth::user()->rol_tipus === 'client') {

        $esValid = redirect()->route('treballador');

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
}