<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRenegociacion extends Model
{
    use HasFactory;

    protected $fillable = [
        "renegociacion_id",
        "prestamo_id",
        "tipo_id",
        "numeroCuota",
        "cuota",
        "interes",
        "capital",
        "mora",
        "capitalRestante",
        "capitalSaldado",
        "interesSaldado",
        "capitalPendiente",
        "interesPendiente",
        "moraPendiente",
        "pagada",
        "fecha",
    ];
}
