<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garante extends Model
{
    use HasFactory;

    protected $fillable = ["nombres", "numeroIdentificacion", "prestamo_id", "telefono", "direccion"];
}
