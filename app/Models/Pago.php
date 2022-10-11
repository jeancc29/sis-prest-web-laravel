<?php

namespace App\Models;

use App\Traits\BelongsToCaja;
use App\Traits\BelongsToCompania;
use App\Traits\BelongsToPrestamo;
use App\Traits\BelongsToUser;
use App\Traits\SetearUserYCompaniaIdYFiltrarPorCompania;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory, SetearUserYCompaniaIdYFiltrarPorCompania, BelongsToCompania, BelongsToUser, BelongsToCaja, BelongsToPrestamo;

    protected $fillable = [
        "id", "user_id", "caja_id", "compania_id", "cliente_id", "prestamo_id", "tipo_id_pago", "monto", "descuento", "devuelta", "comentario", "concepto", "status", "fecha", "esAbonoACapital", "tipo_id_abono_a_capital", "esRenegociacion", "renegociacion_id"
    ];

    public function prestamo()
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(Prestamo::class);
    }

    public function cliente()
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(Cliente::class);
    }

    public function tipo()
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(Tipo::class, "tipo_id_pago");
    }

    public function tipoAbonoCapital()
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(Tipo::class, "tipo_id_abono_a_capital");
    }

    public function detallePago(){
        return $this->hasToMany(DetallePago::class);
    }

    public function renegociacion()
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(Renegociacion::class, "renegociacion_id");
    }
}
