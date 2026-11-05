<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuari extends Authenticatable
{
    use HasFactory;

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
        // El projecte desa la contrasenya a "contrasenya", no a la columna per defecte d'Laravel.
        return $this->contrasenya;
    }

    public function getEmailForPasswordReset()
    {
        // Laravel utilitza aquest correu per associar el token de recuperació amb el compte.
        return $this->correu;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['contrasenya'] = $value;
    }
}
