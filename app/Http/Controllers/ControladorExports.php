<?php

namespace App\Http\Controllers;

use App\Exports\TasquesExport;

class ControladorExports extends Controller
{
    public function tasques()
    {
        $export = new TasquesExport;
        $excel = new \PHPExcel();
        $sheet = $excel->getActiveSheet();
        $files = collect($export->collection())
            ->map(fn ($fila) => array_values((array) $fila))
            ->all();

        $sheet->fromArray(array_merge([$export->headings()], $files));

        return response()->streamDownload(function () use ($excel) {
            $writer = new \PHPExcel_Writer_Excel2007($excel);
            $writer->save('php://output');
        }, 'tasques.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}