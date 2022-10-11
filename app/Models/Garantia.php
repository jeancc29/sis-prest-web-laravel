<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory, BelongsToCompania, SetearYFiltrarPorCompaniaId;

    protected $fillable = ["tasacion", "descripcion", "comentario", "matricula", "marca", "modelo", "chasis", "estado", "placa",
        "anoFabricacion", "motorOSerie", "cilindros", "color", "numeroPasajeros", "numeroPuertas", "fuerzaMotriz", "capacidadCarga",
        "placaAnterior", "fechaExpedicion", "foto", "fotoMatricula", "fotoLicencia", "compania_id", "prestamo_id", "tipo_id",
        "tipo_id_condicion"];
}
