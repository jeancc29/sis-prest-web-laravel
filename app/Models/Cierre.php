<?php

namespace App\Models;

use App\Traits\BelongsToCaja;
use App\Traits\BelongsToCompania;
use App\Traits\BelongsToUser;
use App\Traits\SetearUserYCompaniaIdYFiltrarPorCompania;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cierre extends Model
{
    use HasFactory, SetearUserYCompaniaIdYFiltrarPorCompania, BelongsToCompania, BelongsToUser, BelongsToCaja;

    protected $fillable = [
        'user_id',
        'compania_id',
        'caja_id',
        'totalSegunUsuario',
        'totalSegunSistema',
        'montoEfectivo',
        'montoCheques',
        'montoTarjetas',
        'montoTransferencias',
        'diferencia',
        'comentario',
        'estado',
    ];

    public function transacciones(){
        return $this->belongsToMany(Transaccion::class);
    }
}
