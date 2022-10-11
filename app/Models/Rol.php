<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory, BelongsToCompania, SetearYFiltrarPorCompaniaId;

    protected $fillable = [
        "id", "descripcion", "entidad_id", "compania_id"
    ];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class)->withPivot('created_at');
    }
}
