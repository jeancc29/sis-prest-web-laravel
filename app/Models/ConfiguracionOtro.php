<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionOtro extends Model
{
    use HasFactory;

    protected $fillable = [
        "compania_id",
        "ocultarInteresAmortizacion",
        "requirirSeleccionarCaja",
        "calcularComisionACuota",
    ];
}
