<?php

namespace App\Traits;

use App\Models\Compania;

trait BelongsToCompania{
    public function compania(){
        return $this->belongsTo(Compania::class);
    }
}
