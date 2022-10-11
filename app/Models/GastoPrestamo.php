<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoPrestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "prestamo_id",
        "tipo_id",
        "porcentaje",
        "importe",
        "incluirEnElFinanciamiento",
    ];
}
