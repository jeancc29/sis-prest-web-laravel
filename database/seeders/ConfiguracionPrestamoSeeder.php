<?php

namespace Database\Seeders;

use App\Models\ConfiguracionPrestamo;
use Illuminate\Database\Seeder;

class ConfiguracionPrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->datosDePruebaPorDefectoEnProduction();
    }

    public function datosDePruebaPorDefectoEnProduction(){
        $configuracionPrestamo = ConfiguracionPrestamo::first();
        if($configuracionPrestamo != null)
            return;

        ConfiguracionPrestamo::create([
            "garantia" => 0,
            "gasto" => 0,
            "compania_id" => 1
        ]);
    }
}
