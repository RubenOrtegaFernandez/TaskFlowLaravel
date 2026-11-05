<?php

namespace App\Http\Controllers;

use App\Exports\TasquesExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ControladorExports extends Controller
{
    public function tasques(): BinaryFileResponse|RedirectResponse
    {
        $esValid = null;

        // L'exportació general només està disponible per als rols de gestió.
        if (! Auth::check()) {
            $esValid = redirect()->route('login');
        } elseif (Auth::user()->rol_tipus === 'client') {
            $esValid = redirect()->route('dashboardtreballador.index');
        } else {
            $esValid = Excel::download(new TasquesExport, 'tasques.xlsx');
        }

        return $esValid;
    }
}
