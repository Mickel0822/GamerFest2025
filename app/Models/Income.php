<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    // Agregar estos campos al arreglo fillable para permitir la asignación masiva
    protected $fillable = [
        'description',  // Descripción del ingreso
        'amount',       // Monto del ingreso
        'date',         // Fecha del ingreso
    ];
}
