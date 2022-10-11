<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Query\Builder;

trait BelongsToUser{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
