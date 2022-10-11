<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desembolso extends Model
{
    use HasFactory;

    protected $fillable = [
        "tipo_id",
        "banco_id",
        "cuenta_id",
        "numeroCheque",
        "banco_id_destino",
        "cuentaDestino",
        "montoBruto",
        "montoNeto"
    ];
}
