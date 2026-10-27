<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Departament extends Model
{
    protected $table = 'departaments';

    protected $primaryKey = 'id_dep';

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];

    public function cap(): HasOne
    {
        return $this->hasOne(Usuari::class, 'id_dep', 'id_dep')->where('rol_tipus', 'cap');
    }

    public function treballadors(): HasMany
    {
        return $this->hasMany(Usuari::class, 'id_dep', 'id_dep')->where('rol_tipus', 'client');
    }
}
