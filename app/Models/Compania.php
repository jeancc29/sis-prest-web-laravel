<?php

namespace App\Models;

use App\Traits\MorphOneFoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
    use HasFactory, MorphOneFoto;

    protected $fillable = [
        "nombre",
        "estado",
        "diasGracia",
        "porcentajeMora",
        "tipo_id_mora",
        "direccion",
        "moneda_id",
        "nacionalidad_id"
    ];

    public function tipoMora(){
        return $this->belongsTo(Tipo::class, "tipo_id_mora");
    }

    public function contacto(){
        return $this->morphOne(Contacto::class, "contactoable");
    }

    public function moneda(){
        return $this->belongsTo(Moneda::class);
    }
}
