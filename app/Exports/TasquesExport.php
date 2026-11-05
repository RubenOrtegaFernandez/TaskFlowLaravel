<?php

namespace App\Exports;

use App\Models\Tasca;
use Illuminate\Support\Collection;

class TasquesExport
{
    public function collection(): Collection
    {
        return Tasca::with(['assignat', 'creador', 'departament'])
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
    }

    public function headings(): array
    {
        return ['ID', 'Nom', 'Descripció', 'Estat', 'Prioritat', 'Categoria', 'Data inici', 'Data final', 'Assignat', 'Creador', 'Departament'];
    }
}