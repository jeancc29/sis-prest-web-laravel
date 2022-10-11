<?php

namespace App\Models;

use App\Traits\BelongsToCaja;
use App\Traits\BelongsToCompania;
use App\Traits\BelongsToUser;
use App\Traits\SetearUserYCompaniaIdYFiltrarPorCompania;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory, SetearUserYCompaniaIdYFiltrarPorCompania, BelongsToUser, BelongsToCompania, BelongsToCaja;

    protected $fillable = ["monto", "porcentajeInteres", "porcentajeInteresAnual", "montoInteres", "numeroCuotas",
        "fecha", "fechaPrimerPago", "codigo", "porcentajeMora", "diasGracia", "capitalTotal", "interesTotal", "capitalPendiente",
        "interesPendiente", "mora", "cuota", "numeroCuotasPagadas", "cuotasAtrasadas", "diasAtrasados", "estado",
        "fechaProximoPago", "compania_id", "user_id", "cliente_id", "tipo_id_plazo", "tipo_id_amortizacion", "caja_id", "user_id_cobrador",
        "ruta_id", "desembolso_id", "moneda_id"
    ];

    public function cobrador(){
        return $this->belongsTo(User::class, "user_id_cobrador");
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function tipoPlazo(){
        return $this->belongsTo(Tipo::class, "tipo_id_plazo");
    }

    public function tipoAmortizacion(){
        return $this->belongsTo(Tipo::class, "tipo_id_amortizacion");
    }

    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }
}
