<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;

    protected $fillable = [
        "id", "descripcion"
    ];

    public function permisos()
    {
        //Modelo, foreign key, foreign key, local key, local key
        return $this->belongsTo(Permiso::class);
    }
}
