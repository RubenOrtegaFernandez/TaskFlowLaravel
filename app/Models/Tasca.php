<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasca extends Model
{
    protected $table = 'tasques';

    protected $primaryKey = 'id_tas';

    public $timestamps = false;

    public const CATEGORIES = ['valor1', 'valor2', 'valor3', 'valor4'];

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
        'id_usr_assignat'
    ];

    protected $casts = [
        'data_inici' => 'datetime',
        'data_final' => 'datetime',
    ];

    public function creador()
    {
        return $this->belongsTo(Usuari::class, 'id_usr_creador', 'id_correu');
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class, 'id_dep_assignat', 'id_dep');
    }

    public function assignat()
    {
        return $this->belongsTo(Usuari::class, 'id_usr_assignat', 'id_correu');
    }
}