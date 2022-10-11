<?php

namespace App\Models;

use App\Traits\BelongsToCompania;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionPrestamo extends Model
{
    use HasFactory, BelongsToCompania;

    protected $fillable = [
        "id",
        "garantia",
        "gasto",
        "desembolso",
        "compania_id",
    ];
}
