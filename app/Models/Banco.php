<?php

namespace App\Models;

use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banco extends Model
{
    use HasFactory, SoftDeletes, SetearYFiltrarPorCompaniaId;

    protected $fillable = ["descripcion", "estado", "compania_id"];

    public function cuentas(){
        return $this->hasMany(Cuenta::class);
    }
}
