<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        $persona = $this->persona;
        return [
            "id" => $this->id,
            "estado" => $this->estado,
            "compania_id" => $this->compania_id,
            "rol_id" => $this->rol_id,
            "nombres" => $persona->nombres,
            "apellidos" => $persona->apellidos,
            "usuario" => $this->usuario,
            "permisos" => $this->permisos,
            "compania" => $this->compania,
        ];
    }
}
