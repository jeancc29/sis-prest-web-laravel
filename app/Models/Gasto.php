<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use App\Traits\BelongsToUser;
use App\Traits\SetearUserYCompaniaIdYFiltrarPorCompania;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory, BelongsToCompania, BelongsToUser, SetearUserYCompaniaIdYFiltrarPorCompania;

    protected $fillable = ["fecha", "concepto", "monto", "comentario", "caja_id", "user_id", "tipo_id", "tipo_id_pago", "compania_id"];

}
