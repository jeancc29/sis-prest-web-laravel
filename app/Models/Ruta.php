<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory, BelongsToCompania, SetearYFiltrarPorCompaniaId;

    protected $fillable = ["descripcion", "compania_id"];
}
