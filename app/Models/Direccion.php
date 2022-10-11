<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $fillable = ["direccion", "direccion2", "postal_code", "direccionable_id", "direccionable_type"];

    public function direccionable()
    {
        $this->morphTo();
    }
}
