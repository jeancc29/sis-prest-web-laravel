<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    protected $fillable = ["nombre", "tipo", "tiempoExistencia"];

    public function direccion(){
        return $this->morphOne(Direccion::class, "direccionable");
    }

    public function contacto(){
        return $this->morphOne(Contacto::class, "contactoable");
    }
}
