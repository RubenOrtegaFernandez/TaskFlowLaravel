<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $table = 'departaments';

    protected $primaryKey = 'id_dep';

    public $timestamps = false;

    protected $fillable = [
        'nom_dep',
    ];

    public function usuaris()
    {
        return $this->hasMany(Usuari::class, 'id_dep', 'id_dep'); //hasMany porque es 1:N
    }
}
