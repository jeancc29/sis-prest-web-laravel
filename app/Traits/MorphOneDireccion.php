<?php

namespace App\Traits;

use App\Models\Direccion;

trait MorphOneDireccion{
    public function direccion(){
        return $this->morphOne(Direccion::class, "direccionable");
    }
}
