<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renegociacion extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "prestamo_id",
        "monto",
        "porcentajeInteres",
        "porcentajeInteresAnual",
        "montoInteres",
        "numeroCuotas",
        "fecha",
        "fechaPrimerPago",
        "porcentajeMora",
        "diasGracia",
        "capitalTotal",
        "interesTotal",
        "capitalPendiente",
        "interesPendiente",
        "mora",
        "cuota",
        "numeroCuotasPagadas",
        "cuotasAtrasadas",
        "diasAtrasados",
        "fechaProximoPago",
        "tipo_id_plazo",
        "tipo_id_amortizacion",
    ];

    public function detalleRenegociacion()
    {
        //Modelo, foreign key, foreign key, local key, local key
        return $this->belongsToMany(DetalleRenegociacion::class);
    }
}
