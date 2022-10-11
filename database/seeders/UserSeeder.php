<?php

namespace Database\Seeders;

use App\Models\Compania;
use App\Models\Contacto;
use App\Models\Persona;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->crearUsuarioPorDefecto();
    }

    public function crearUsuarioPorDefecto(){
        $compania = Compania::whereNombre("Prueba")->first();

        $rol = Rol::whereDescripcion("Programador")->first();


        $usuario = User::updateOrCreate(
            ["usuario" => "jeancc29"],
            [
                "email" => "jean29@no.com",
                "password" => Crypt::encryptString(\config('data.password')),
                "estado" => 1,
                "sucursal_id" => 1,
                "compania_id" => $compania->id,
                "rol_id" => $rol->id,
            ]
        );

        Persona::query()->updateOrCreate(
            ["personaable_type" => User::class,"personaable_id" => $usuario->id,],
            [
                "nombres" => "Jean Carlos",
                "apellidos" => "Contreras Rodriguez",
            ]
        );


        $contactoUsuario = Contacto::updateOrCreate(
            ["correo" => "jeancon29@gmail.com"],
            [
                "telefono" => "8294266800",
                "celular" => "8493406800",
                "contactoable_id" => $usuario->id,
                "contactoable_type" => User::class,
            ]
        );

        $permisos = collect($rol->permisos)->map(function($d) use($usuario){
            return ["permiso_id" => $d["id"], "user_id" => $usuario->id];
        });
        $usuario->permisos()->detach();
        $usuario->permisos()->attach($permisos);
    }
}
