<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\BelongsToCompania;
use App\Traits\MorphOneContacto;
use App\Traits\MorphOneDireccion;
use App\Traits\MorphOneFoto;
use App\Traits\MorphOnePersona;
use App\Traits\SetearYFiltrarPorCompaniaId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BelongsToCompania, MorphOneDireccion, MorphOneContacto, MorphOnePersona, MorphOneFoto, SetearYFiltrarPorCompaniaId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];

    protected $fillable = [
//        'name',
        'email',
        'password',
        'usuario',
        'estado',
        'compania_id',
        'rol_id',
        'sucursal_id',
        'ruta_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permisos() : BelongsToMany{
        return $this->belongsToMany(Permiso::class)->withPivot("created_at");
    }
}
