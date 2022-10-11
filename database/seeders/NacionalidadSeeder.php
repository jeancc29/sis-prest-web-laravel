<?php

namespace Database\Seeders;

use App\Models\Compania;
use App\Models\Nacionalidad;
use Illuminate\Database\Seeder;

class NacionalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Argentino"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Boliviano"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Chileno"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Colombiano"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Costarricense"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Cubano"]
        );
        $n = Nacionalidad::updateOrCreate(
            ["descripcion" => "Dominicano"]
        );
        Compania::query()->update(["nacionalidad_id" => $n->id]);
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Ecuatoriano"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Español"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Guatemalteco"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Haitiano"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Hondureño"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Mexicano"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Nicaragüense"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Panameño"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Peruano"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Puertorriqueño"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Paraguayo"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Salvadoreño"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Estadounidense"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Uruguayo"]
        );
        Nacionalidad::updateOrCreate(
            ["descripcion" => "Venenzolano"]
        );
    }
}
