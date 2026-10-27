<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    protected $table = 'tasques';

    protected $primaryKey = 'id_tasca'; // cambia esto por el nombre real de tu clave primaria

    public $timestamps = false;

    protected $fillable = [
        'categoria',
        // el resto de tus campos
    ];

    public static function categoriaOptions(): array
    {
        $row = DB::selectOne("SHOW COLUMNS FROM tasques LIKE 'categoria'");

        preg_match_all("/'([^']+)'/", $row->Type, $matches);

        $opcions = $matches[1];

        return $opcions;
    }
}