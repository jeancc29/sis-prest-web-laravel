<?php

namespace App\Traits;

use App\Models\Contacto;

trait MorphOneContacto{
    public function contacto(){
        return $this->morphOne(Contacto::class, "contactoable");
    }
}
