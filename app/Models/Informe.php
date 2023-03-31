<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;
    protected $table = 'informe';
    protected $fillable = [
        'id_usuario',
        'usuario',
        'nombre_dirigido',
        'cargo',
        'unidad',
        'referencia',
        'tipo_informe',
        'fecha',
        'dato_informe',
        'observacion',
        'estado',
        'id_oficina',
        'oficina',
        'numero',
    ];
}
