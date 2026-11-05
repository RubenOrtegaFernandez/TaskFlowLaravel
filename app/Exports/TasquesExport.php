<?php

namespace App\Exports;

use App\Models\Tasca;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasquesExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        $tasques = Tasca::with(['assignat', 'creador', 'departament']);

        // Els caps només exporten les tasques del seu departament.
        if (Auth::user()->rol_tipus === 'cap') {
            if (! Auth::user()->id_dep) {
                $tasques->whereRaw('1 = 0');
            } else {
                $tasques->where('id_dep_assignat', Auth::user()->id_dep);
            }
        }

        $resultat = $tasques
            ->get()
            ->map(function ($tasca) {
                return [
                    'ID' => $tasca->id_tas,
                    'Nom' => $tasca->nom_tas,
                    'Descripció' => $tasca->descripcio,
                    'Estat' => $tasca->estat,
                    'Prioritat' => $tasca->prioritat,
                    'Categoria' => $tasca->categoria,
                    'Data inici' => $tasca->data_inici,
                    'Data final' => $tasca->data_final,
                    'Assignat' => $tasca->assignat->nom_usu ?? '',
                    'Creador' => $tasca->creador->nom_usu ?? '',
                    'Departament' => $tasca->departament->nom_dep ?? '',
                ];
            });

        return $resultat;
    }

    public function headings(): array
    {
        return ['ID', 'Nom', 'Descripció', 'Estat', 'Prioritat', 'Categoria', 'Data inici', 'Data final', 'Assignat', 'Creador', 'Departament'];
    }
}
