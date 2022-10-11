<?php

namespace App\Models;

use App\Traits\BelongsToPrestamo;
use App\Traits\BelongsToTipo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAbono extends Model
{
    use HasFactory, BelongsToTipo, BelongsToPrestamo;

    protected $fillable = [
        "id",
        "numeroCuota",
        "tipo_id",
        "prestamo_id",
        "pago_id",
        "cuota",
        "interes",
        "capital",
        "capitalRestante",
        "capitalSaldado",
        "interesSaldado",
        "fecha",
        "capitalPendiente",
        "interesPendiente",
        "moraPendiente",
        "pagada",
    ];
}
