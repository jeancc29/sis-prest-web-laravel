<?php

namespace App\Traits;

use App\Models\Prestamo;
use Illuminate\Database\Query\Builder;

trait BelongsToPrestamo{
    public function prestamo(){
        return $this->belongsTo(Prestamo::class);
    }
}
