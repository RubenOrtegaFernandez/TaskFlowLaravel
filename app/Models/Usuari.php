<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $hidden = ['contrasenya'];

    public function departament()
    {
        return $this->belongsTo(Departament::class, 'id_dep', 'id_dep'); // belongsTo porque es N:1
    }

    public function tasquesAssignades(): HasMany
    {
        return $this->hasMany(Tasca::class, 'id_usr_assignat', 'id_correu');
    }

    public function tasquesCreades(): HasMany
    {
        return $this->hasMany(Tasca::class, 'id_usr_creador', 'id_correu');
    }

    public function getAuthPassword()
    {
        return $this->contrasenya;
    }

    public function getEmailForPasswordReset()
    {
        return $this->correu;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['contrasenya'] = $value;
    }
}
