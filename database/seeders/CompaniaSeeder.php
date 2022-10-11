<?php

namespace Database\Seeders;

use App\Models\Compania;
use App\Models\Contacto;
use App\Models\Direccion;
use App\Models\Moneda;
use App\Models\Nacionalidad;
use App\Models\Tipo;
use Illuminate\Database\Seeder;

class CompaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->crearCompaniaPorDefecto();
    }

    public function crearCompaniaPorDefecto(){
        $tipo = Tipo::where(["categoria" => "mora", "descripcion" => "Capital pendiente"])->first();
        $moneda = Moneda::where(["codigo" => "DOP"])->first();
        $nacionalidad = Nacionalidad::whereDescripcion("Dominicano")->first();

//        $pais = Country::whereNombre("Republica Dominicana")->first();
//        $estado = State::where(["nombre" => "Santiago", "idPais" => $pais->id])->first();
//        $ciudad = City::where(["nombre" => "Santiago", "idEstado" => $estado->id])->first();


        $empresa = Compania::updateOrCreate(
            ["nombre" => "Prueba"],
            [
                "estado" => 1,
                "tipo_id_mora" => $tipo->id,
                "moneda_id" => $moneda->id,
//                "contacto_id" => $contacto->id,
//                "compania_id" => 1,
            "nacionalidad_id" => $nacionalidad->id
            ]
        );

        $contacto = Contacto::updateOrCreate(
            ["correo" => "no@no.com"],
            [
                "telefono" => "8294266800",
                "rnc" => "123456",
                "contactoable_id" => $empresa->id,
                "contactoable_type" => Compania::class

            ]
        );

        $direccion = Direccion::updateOrCreate(
            ["direccion" => "Direccion de prueba"],
            [
                "direccion2" => "hola",
                "codigoPostal" => '',
                "direccionable_id" => $empresa->id,
                "direccionable_type" => Compania::class
            ]
        );
    }
}
