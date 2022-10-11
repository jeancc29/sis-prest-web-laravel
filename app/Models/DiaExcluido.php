<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaExcluido extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "prestamo_id",
        "dia_id",
    ];
}
