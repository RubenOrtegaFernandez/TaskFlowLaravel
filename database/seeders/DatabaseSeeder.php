<?php

namespace Database\Seeders;

use App\Models\Departament;
use App\Models\Usuari;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $informatica = Departament::create([
            'nom' => 'Informática',
        ]);

        $administracio = Departament::create([
            'nom' => 'Administración',
        ]);

        $recursosHumans = Departament::create([
            'nom' => 'Recursos Humanos',
        ]);

        $marketing = Departament::create([
            'nom' => 'Marketing',
        ]);

        Usuari::create([
            'nom_usu' => 'Administrador',
            'correu' => 'admin@taskflow.com',
            'rol_tipus' => 'admin',
            'contrasenya' => Hash::make('admin123'),
            'id_dep' => $informatica->id_dep,
        ]);

        Usuari::create([
        'nom_usu' => 'Juan',
        'correu' => 'juan@taskflow.com',
        'rol_tipus' => 'cap',
        'contrasenya' => Hash::make('juan123'),
        'id_dep' => $informatica->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Maria',
            'correu' => 'maria@taskflow.com',
            'rol_tipus' => 'cap',
            'contrasenya' => Hash::make('maria123'),
            'id_dep' => $administracio->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Pedro',
            'correu' => 'pedro@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('pedro123'),
            'id_dep' => $informatica->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Manolo',
            'correu' => 'manolo@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('manolo123'),
            'id_dep' => $informatica->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Laura',
            'correu' => 'laura@taskflow.com',
            'rol_tipus' => 'cap',
            'contrasenya' => Hash::make('laura123'),
            'id_dep' => $recursosHumans->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Carlos',
            'correu' => 'carlos@taskflow.com',
            'rol_tipus' => 'cap',
            'contrasenya' => Hash::make('carlos123'),
            'id_dep' => $marketing->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Luis',
            'correu' => 'luis@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('luis123'),
            'id_dep' => $administracio->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Marta',
            'correu' => 'marta@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('marta123'),
            'id_dep' => $administracio->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Sergi',
            'correu' => 'sergi@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('sergi123'),
            'id_dep' => $recursosHumans->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Elena',
            'correu' => 'elena@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('elena123'),
            'id_dep' => $recursosHumans->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Pau',
            'correu' => 'pau@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('pau123'),
            'id_dep' => $marketing->id_dep,
        ]);

        Usuari::create([
            'nom_usu' => 'Nuria',
            'correu' => 'nuria@taskflow.com',
            'rol_tipus' => 'client',
            'contrasenya' => Hash::make('nuria123'),
            'id_dep' => $marketing->id_dep,
        ]);

        $this->call([
            TascaSeeder::class,
        ]);
    }
}