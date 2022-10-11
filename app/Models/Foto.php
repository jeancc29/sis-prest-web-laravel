<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ["foto", "fotoable_id", "fotoable_type"];

    public function fotoable()
    {
        $this->morphTo();
    }
}
