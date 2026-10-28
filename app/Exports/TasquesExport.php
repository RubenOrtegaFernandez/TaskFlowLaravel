<?php

namespace App\Exports;

use App\Models\Tasca;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasquesExport implements FromCollection, WithHeadings
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
                    'Treballador assignat' => $tasca->assignat
                        ? $tasca->assignat->id_correu
                        : 'Sense assignar',
                    'Creador' => $tasca->creador
                        ? $tasca->creador->id_correu
                        : 'Desconegut',
                    'Departament' => $tasca->departament
                        ? $tasca->departament->id_dep
                        : 'Sense departament',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Descripció',
            'Estat',
            'Prioritat',
            'Categoria',
            'Data inici',
            'Data final',
            'Treballador assignat',
            'Creador',
            'Departament',
        ];
    }
}
