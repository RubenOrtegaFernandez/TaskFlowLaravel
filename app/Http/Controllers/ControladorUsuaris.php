<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ControladorUsuaris
{
    public function index()
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $resposta = redirect()->route('dashboardtreballador.index');
        } else {
            $usuaris = Usuari::with(['departament.cap'])
                ->orderBy('nom_usu');

            if (Auth::user()->rol_tipus === 'cap') {
                if (Auth::user()->id_dep) {
                    $usuaris->where('id_dep', Auth::user()->id_dep)
                        ->whereIn('rol_tipus', ['cap', 'client']);
                } else {
                    $usuaris->where('id_correu', Auth::id());
                }
            }

            $resposta = view('treballadors.llistaTreballadors', [
                'treballadors' => $usuaris->get(),
            ]);
        }

        return $resposta;
    }

    public function show(Usuari $usuari)
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $resposta = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap'
            && (Auth::user()->id_dep != $usuari->id_dep
                || $usuari->rol_tipus === 'admin'
                || (!Auth::user()->id_dep && Auth::id() != $usuari->id_correu))) {
            $resposta = redirect()->route('dashboardcap.index');
        } else {
            $usuari->load(['departament.cap'])->loadCount(['tasquesAssignades', 'tasquesCreades']);
            $resposta = view('usuari.veureUsuari', compact('usuari'));
        }

        return $resposta;
    }

    public function edit(Usuari $usuari)
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $resposta = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap'
            && ($usuari->rol_tipus !== 'client' || !Auth::user()->id_dep || Auth::user()->id_dep != $usuari->id_dep)) {
            $resposta = redirect()->route('dashboardcap.index');
        } else {
            $resposta = view('usuari.editarUsuari', [
                'usuari' => $usuari,
                'departaments' => Auth::user()->rol_tipus === 'admin' ? Departament::orderBy('nom')->get() : collect(),
                'administrador' => Auth::user()->rol_tipus === 'admin',
            ]);
        }

        return $resposta;
    }

    public function update(Request $request, Usuari $usuari)
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $resposta = redirect()->route('dashboardtreballador.index');
        } elseif (Auth::user()->rol_tipus === 'cap'
            && ($usuari->rol_tipus !== 'client' || !Auth::user()->id_dep || Auth::user()->id_dep != $usuari->id_dep)) {
            $resposta = redirect()->route('dashboardcap.index');
        } else {
            $esAdministrador = Auth::user()->rol_tipus === 'admin';
            $regles = [
                'nom_usu' => ['required', 'string', 'max:25'],
                'correu' => ['required', 'email', 'max:255', Rule::unique('usuaris', 'correu')->ignore($usuari->id_correu, 'id_correu')],
            ];

            if ($esAdministrador) {
                $regles = array_merge($regles, [
                    'rol_tipus' => ['required', Rule::in(['admin', 'cap', 'client'])],
                    'id_dep' => ['nullable', 'exists:departaments,id_dep'],
                    'contrasenya_nova' => ['nullable', 'string', 'min:8', 'confirmed'],
                ]);
            }

            $dades = $request->validate($regles);

            $errorDepartament = null;

            if ($esAdministrador && Auth::id() == $usuari->id_correu && $dades['rol_tipus'] !== 'admin') {
                $errorDepartament = 'No pots canviar el rol del teu propi compte d’administrador.';
            } elseif ($esAdministrador && $dades['rol_tipus'] === 'cap' && empty($dades['id_dep'])) {
                $errorDepartament = 'Un cap ha de tenir un departament assignat.';
            } elseif ($esAdministrador && $dades['rol_tipus'] === 'cap' && Usuari::where('rol_tipus', 'cap')
                ->where('id_dep', $dades['id_dep'])
                ->where('id_correu', '!=', $usuari->id_correu)
                ->exists()) {
                $errorDepartament = 'Aquest departament ja té un cap assignat.';
            }

            if ($errorDepartament) {
                $campError = Auth::id() == $usuari->id_correu && $dades['rol_tipus'] !== 'admin' ? 'rol_tipus' : 'id_dep';
                $resposta = back()->withErrors([$campError => $errorDepartament])->withInput();
            } else {
                $usuari->nom_usu = $dades['nom_usu'];
                $usuari->correu = $dades['correu'];

                if ($esAdministrador) {
                    $usuari->rol_tipus = $dades['rol_tipus'];
                    $usuari->id_dep = $dades['id_dep'] ?? null;

                    if (!empty($dades['contrasenya_nova'])) {
                        $usuari->contrasenya = Hash::make($dades['contrasenya_nova']);
                    }
                }

                $usuari->save();
                $rutaUsuariIndex = Auth::user()->rol_tipus === 'cap' ? 'cap.usuaris.index' : 'usuari.index';
                $resposta = redirect()->route($rutaUsuariIndex)->with('status', 'Usuari actualitzat correctament.');
            }
        }

        return $resposta;
    }

    public function delete(Usuari $usuari)
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $resposta = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } elseif (Auth::id() == $usuari->id_correu) {
            $rutaUsuariIndex = Auth::user()->rol_tipus === 'cap' ? 'cap.usuaris.index' : 'usuari.index';
            $resposta = redirect()->route($rutaUsuariIndex)->with('error', 'No pots esborrar el teu propi usuari.');
        } else {
            $usuari->load('departament');
            $resposta = view('usuari.esborrarUsuari', compact('usuari'));
        }

        return $resposta;
    }

    public function destroy(Usuari $usuari)
    {
        $resposta = null;

        if (!Auth::check()) {
            $resposta = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus !== 'admin') {
            $resposta = redirect()->route(Auth::user()->rol_tipus === 'cap' ? 'dashboardcap.index' : 'dashboardtreballador.index');
        } elseif (Auth::id() == $usuari->id_correu) {
            $rutaUsuariIndex = Auth::user()->rol_tipus === 'cap' ? 'cap.usuaris.index' : 'usuari.index';
            $resposta = redirect()->route($rutaUsuariIndex)->with('error', 'No pots esborrar el teu propi usuari.');
        } else {
            DB::transaction(function () use ($usuari) {
                Tasca::where('id_usr_assignat', $usuari->id_correu)->update(['id_usr_assignat' => null]);
                Tasca::where('id_usr_creador', $usuari->id_correu)->update(['id_usr_creador' => null]);
                $usuari->delete();
            });

            $rutaUsuariIndex = Auth::user()->rol_tipus === 'cap' ? 'cap.usuaris.index' : 'usuari.index';
            $resposta = redirect()->route($rutaUsuariIndex)->with('status', 'Usuari esborrat. Les tasques s’han conservat.');
        }

        return $resposta;
    }
}
