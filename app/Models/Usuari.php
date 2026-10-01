<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuari extends Authenticatable
{
    protected $table = 'usuaris';

    protected $primaryKey = 'id_correu';

    public $timestamps = false;

    protected $fillable = [
        'nom_usu',
        'correu',
        'rol_tipus',
        'foto_perfil',
        'contrasenya',
        'id_dep',
    ];

    public function departament()
    {
        return $this->belongsTo(Departament::class, 'id_dep', 'id_dep'); // belongsTo porque es N:1
    }

    public function getAuthPassword()
    {
        return $this->contrasenya;
    }
}