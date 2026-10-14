<?php

namespace Database\Seeders;

use App\Models\Departament;
use App\Models\Tasca;
use App\Models\Usuari;
use Illuminate\Database\Seeder;

class TascaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Usuari::where('correu', 'admin@taskflow.com')->first();
        $juan = Usuari::where('correu', 'juan@taskflow.com')->first();
        $maria = Usuari::where('correu', 'maria@taskflow.com')->first();
        $pedro = Usuari::where('correu', 'pedro@taskflow.com')->first();

        $informatica = Departament::where('nom', 'Informática')->first();
        $administracio = Departament::where('nom', 'Administración')->first();

        Tasca::create([
            'estat' => 'pendent',
            'nom_tas' => 'Revisar servidor',
            'descripcio' => 'Comprovar l\'estat del servidor principal.',
            'data_inici' => '2026-10-14 09:00:00',
            'data_final' => '2026-10-20 18:00:00',
            'prioritat' => 'urgent',
            'categoria' => 'General',
            'id_usr_creador' => $admin->id_correu,
            'id_dep_assignat' => $informatica->id_dep,
            'id_usr_assignat' => $pedro->id_correu,
        ]);

        Tasca::create([
            'estat' => 'en_curs',
            'nom_tas' => 'Actualitzar web',
            'descripcio' => 'Posar al dia el contingut de la pàgina web.',
            'data_inici' => '2026-10-10 09:00:00',
            'data_final' => '2026-10-25 18:00:00',
            'prioritat' => 'alta',
            'categoria' => 'Desenvolupament',
            'id_usr_creador' => $juan->id_correu,
            'id_dep_assignat' => $informatica->id_dep,
            'id_usr_assignat' => $pedro->id_correu,
        ]);

        Tasca::create([
            'estat' => 'fet',
            'nom_tas' => 'Preparar factures',
            'descripcio' => 'Revisar i enviar les factures del mes.',
            'data_inici' => '2026-10-01 09:00:00',
            'data_final' => '2026-10-12 18:00:00',
            'prioritat' => 'mitja',
            'categoria' => 'Administració',
            'id_usr_creador' => $maria->id_correu,
            'id_dep_assignat' => $administracio->id_dep,
            'id_usr_assignat' => null,
        ]);

        Tasca::create([
            'estat' => 'revisat',
            'nom_tas' => 'Copia de seguretat',
            'descripcio' => 'Fer la còpia de seguretat setmanal.',
            'data_inici' => '2026-09-28 09:00:00',
            'data_final' => '2026-09-30 18:00:00',
            'prioritat' => 'baixa',
            'categoria' => 'General',
            'id_usr_creador' => $admin->id_correu,
            'id_dep_assignat' => $informatica->id_dep,
            'id_usr_assignat' => null,
        ]);
    }
}