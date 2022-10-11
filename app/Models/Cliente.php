<?php

namespace App\Models;

use App\Traits\MorphOneContacto;
use App\Traits\MorphOneDireccion;
use App\Traits\MorphOneFoto;
use App\Traits\MorphOnePersona;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Block\Element\Document;

class Cliente extends Model
{
    use HasFactory, SetearYFiltrarPorCompaniaId, MorphOnePersona, MorphOneFoto, MorphOneContacto, MorphOneDireccion;

    protected $fillable = ["apodo", "fechaNacimiento", "numeroDependientes",
        "type_id_sexo", "type_id_estado_civil", "type_id_vivienda", "tiempoEnVivienda", "referidoPor",
        "estado", "compania_id", "documento_id", "nacionalidad_id", "empleo_id", "negocio_id", "type_id_situacion_laboral", "ruta_id"
    ];

    public function documento(){
        return $this->belongsTo(Document::class);
    }

    public function empleo(){
        return $this->belongsTo(Empleo::class);
    }

    public function negocio(){
        return $this->belongsTo(Negocio::class);
    }

    public function nacionalidad(){
        return $this->belongsTo(Nacionalidad::class);
    }
}
