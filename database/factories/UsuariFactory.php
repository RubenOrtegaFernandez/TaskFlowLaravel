<?php

namespace Database\Factories;

use App\Models\Usuari;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Usuari>
 */
class UsuariFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_usu' => fake()->name(),
            'correu' => fake()->unique()->safeEmail(),
            'rol_tipus' => 'client',
            'foto_perfil' => 'img/default.png',
            'contrasenya' => Hash::make('password'),
            'id_dep' => null,
        ];
    }
}
