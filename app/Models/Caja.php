<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caja extends Model
{
    use HasFactory, SoftDeletes, BelongsToCompania, SetearYFiltrarPorCompaniaId;

    protected $fillable = ["descripcion", "balanceInicial", "balance", "compania_id"];

}
