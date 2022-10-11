<?php


namespace App\Traits;

use App\Models\Caja;

trait BelongsToCaja
{
    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }
}
