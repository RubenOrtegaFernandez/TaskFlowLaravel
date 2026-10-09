<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasca extends Model
{
    protected $table = 'tasques';

    protected $primaryKey = 'id_tas';

    public $timestamps = false;

    protected $fillable = [
        'estat',
        'nom_tas',
        'descripcio',
        'data_inici',
        'data_final',
        'prioritat',
        'categoria',
        'id_usr_creador',
        'id_dep_assignat',
    ];

    public function creador()
    {
        return $this->belongsTo(Usuari::class, 'id_usr_creador', 'id_correu');
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class, 'id_dep_assignat', 'id_dep');
    }
}
