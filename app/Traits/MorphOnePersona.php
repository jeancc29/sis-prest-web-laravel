<?php

namespace App\Traits;

use App\Models\Persona;

trait MorphOnePersona{
    public function persona(){
        return $this->morphOne(Persona::class, "personaable");
    }
}
