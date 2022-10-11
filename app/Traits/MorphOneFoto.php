<?php

namespace App\Traits;

use App\Models\Foto;

trait MorphOneFoto{
    public function foto(){
        return $this->morphOne(Foto::class, "fotoable");
    }
}
