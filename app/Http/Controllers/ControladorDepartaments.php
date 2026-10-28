<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ControladorDepartaments
{
    public function validar()
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } else {
            $departaments = Departament::with(['cap', 'treballadors'])->orderBy('nom');

            if (Auth::user()->rol_tipus === 'cap') {
                $departaments->where('id_dep', Auth::user()->id_dep);
            }

            $esValid = view('departament.llistaDepartaments', array(
                'departaments' => $departaments->get(),
            ));
        }

        return $esValid;
    }

    public function create(Request $request)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $esValid = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } else {
            $origen = $request->query('origen') === 'dashboard' ? 'dashboard' : 'list';
            $dadesFormulari = $this->dadesFormulari();
            $dadesFormulari['origen'] = $origen;
            $esValid = view('departament.crearDepartament', $dadesFormulari);
        }

        return $esValid;
    }

    public function store(Request $request)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $esValid = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } else {
            $origen = $request->query('origen') === 'dashboard' ? 'dashboard' : 'list';
            $dades = $request->validate([
                'nom' => 'required|string|max:25',
                'id_cap' => ['nullable', Rule::exists('usuaris', 'id_correu')->where('rol_tipus', 'cap')],
                'treballadors' => 'sometimes|array',
                'treballadors.*' => ['distinct', Rule::exists('usuaris', 'id_correu')->where('rol_tipus', 'client')],
            ]);

            $idsTreballadors = $dades['treballadors'] ?? [];
            $idCap = $dades['id_cap'] ?? null;

            DB::transaction(function () use ($dades, $idsTreballadors, $idCap) {
                $departament = Departament::create(['nom' => $dades['nom']]);

                if ($idCap) {
                    Usuari::where('id_correu', $idCap)->update(['id_dep' => $departament->id_dep]);
                }

                if (count($idsTreballadors) > 0) {
                    Usuari::whereIn('id_correu', $idsTreballadors)->update(['id_dep' => $departament->id_dep]);
                }
            });

            $rutaTornada = $origen === 'dashboard' ? 'dashboardadmin.index' : 'departament.index';
            $esValid = redirect()->route($rutaTornada)->with('status', 'Departament creat correctament.');
        }

        return $esValid;
    }

    public function show(Departament $departament)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap' && Auth::user()->id_dep != $departament->id_dep) {
            $esValid = redirect()->route('dashboardcap.index');
        } else {
            $departament->load(['cap', 'treballadors']);
            $esValid = view('departament.veureDepartament', compact('departament'));
        }

        return $esValid;
    }

    public function edit(Departament $departament)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap' && Auth::user()->id_dep != $departament->id_dep) {
            $esValid = redirect()->route('dashboardcap.index');
        } else {
            $esValid = view('departament.editarDepartament', $this->dadesFormulari($departament));
        }

        return $esValid;
    }

    public function update(Request $request, Departament $departament)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap' && Auth::user()->id_dep != $departament->id_dep) {
            $esValid = redirect()->route('dashboardcap.index');
        } else {
            $esAdmin = Auth::user()->rol_tipus === 'admin';
            $regles = [
                'nom' => 'required|string|max:25',
                'treballadors' => 'sometimes|array',
                'treballadors.*' => ['distinct', Rule::exists('usuaris', 'id_correu')->where('rol_tipus', 'client')],
            ];

            if ($esAdmin) {
                $regles['id_cap'] = ['nullable', Rule::exists('usuaris', 'id_correu')->where('rol_tipus', 'cap')];
            }

            $dades = $request->validate($regles);
            $idsTreballadors = $dades['treballadors'] ?? [];
            $idCap = $dades['id_cap'] ?? null;
            $treballadorsValids = true;

            if (!$esAdmin) {
                $quantitatValida = Usuari::whereIn('id_correu', $idsTreballadors)
                    ->where('rol_tipus', 'client')
                    ->where(function ($consulta) use ($departament) {
                        $consulta->whereNull('id_dep')->orWhere('id_dep', $departament->id_dep);
                    })
                    ->count();

                $treballadorsValids = $quantitatValida === count($idsTreballadors);
            }

            if (!$treballadorsValids) {
                $esValid = back()->withErrors([
                    'treballadors' => 'Només pots afegir treballadors sense departament o del teu departament.',
                ])->withInput();
            } else {
                DB::transaction(function () use ($departament, $dades, $idsTreballadors, $idCap, $esAdmin) {
                    $departament->update(['nom' => $dades['nom']]);

                    if ($esAdmin) {
                        Usuari::where('id_dep', $departament->id_dep)
                            ->where('rol_tipus', 'cap')
                            ->update(['id_dep' => null]);

                        if ($idCap) {
                            Usuari::where('id_correu', $idCap)->update(['id_dep' => $departament->id_dep]);
                        }
                    }

                    Usuari::where('id_dep', $departament->id_dep)
                        ->where('rol_tipus', 'client')
                        ->whereNotIn('id_correu', $idsTreballadors)
                        ->update(['id_dep' => null]);

                    if (count($idsTreballadors) > 0) {
                        Usuari::whereIn('id_correu', $idsTreballadors)->update(['id_dep' => $departament->id_dep]);
                    }
                });

                $esValid = redirect()->route('departament.index')->with('status', 'Departament actualitzat correctament.');
            }
        }

        return $esValid;
    }

    public function delete(Departament $departament)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $esValid = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } else {
            $departament->load(['cap', 'treballadors']);
            $esValid = view('departament.esborrarDepartament', compact('departament'));
        }

        return $esValid;
    }

    public function destroy(Departament $departament)
    {
        $esValid = null;

        if (!Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $esValid = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } else {
            DB::transaction(function () use ($departament) {
                Usuari::where('id_dep', $departament->id_dep)->update(['id_dep' => null]);
                Tasca::where('id_dep_assignat', $departament->id_dep)->update(['id_dep_assignat' => null]);
                $departament->delete();
            });

            $esValid = redirect()->route('departament.index')->with('status', 'Departament esborrat. Les persones i tasques s’han conservat sense departament.');
        }

        return $esValid;
    }

    private function dadesFormulari(?Departament $departament = null): array
    {
        $treballadorsActuals = collect();
        $treballadorsDisponibles = Usuari::with('departament')->where('rol_tipus', 'client');

        if ($departament) {
            $treballadorsActuals = $departament->treballadors()->orderBy('nom_usu')->get();

            if (Auth::user()->rol_tipus === 'cap') {
                $treballadorsDisponibles->whereNull('id_dep');
            } else {
                $treballadorsDisponibles->where(function ($consulta) use ($departament) {
                    $consulta->whereNull('id_dep')->orWhere('id_dep', '!=', $departament->id_dep);
                });
            }
        }

        return [
            'departament' => $departament,
            'origen' => 'list',
            'caps' => Usuari::with('departament')->where('rol_tipus', 'cap')->orderBy('nom_usu')->get(),
            'treballadorsActuals' => $treballadorsActuals,
            'treballadorsDisponibles' => $treballadorsDisponibles->orderBy('nom_usu')->get(),
            'administrador' => Auth::user()->rol_tipus === 'admin',
        ];
    }
}
