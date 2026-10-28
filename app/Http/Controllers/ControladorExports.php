<?php
namespace App\Exports;
use App\Models\Tasca;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ControladorExports implements FromCollection, WithHeadings
{
public function collection(){
    return Tasca::select('nom_tas', 'descripcio', 'estat', 'data_inici', 'data_final', 'prioritat', 'categoria')->get();
}

public function headings(): array{
    return [
    'Nom',
    'Descripció',
    'Estat',
    'Data de inici',
    'Data final',
    'Prioritat',
    'Categoría',];
    }
}