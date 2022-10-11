<?php

namespace App\Traits;

use App\Models\Tipo;
use Illuminate\Database\Query\Builder;

trait BelongsToTipo{
    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }
}
