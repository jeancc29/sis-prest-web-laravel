<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionRecibo extends Model
{
    use HasFactory;

    protected $fillable = [
        "compania_id",
        "copia",
        "capital",
        "mora",
        "interes",
        "descuento",
        "capitalPendiente",
        "balancePendiente",
        "fechaProximoPago",
        "formaPago",
        "firma",
        "mostrarCentavosRecibidos",
    ];
}
