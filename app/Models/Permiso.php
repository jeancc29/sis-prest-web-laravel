<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $fillable = [
        "id", "descripcion", "entidad_id"
    ];

    public function entidad()
    {
        //Modelo, foreign key, local key
        return $this->hasOne(Entidad::class, 'id', 'entidad_id');
    }
}
