<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = ["telefono", "extension", "celular", "fax", "correo", "rnc", "facebook", "instagram", "tipo_id", "contactoable_id", "contactoable_type"];

    public function contactoable()
    {
        $this->morphTo();
    }
}
