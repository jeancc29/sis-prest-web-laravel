<?php

namespace Database\Seeders;

use App\Models\Entidad;
use Illuminate\Database\Seeder;

class EntidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entidad::updateOrCreate(["descripcion" => 'Dashboard'],);
        Entidad::updateOrCreate(["descripcion" => 'Clientes'],);
        Entidad::updateOrCreate(["descripcion" => 'Prestamos'],);
        Entidad::updateOrCreate(["descripcion" => 'Pagos'],);
        Entidad::updateOrCreate(["descripcion" => 'Cajas'],);
        Entidad::updateOrCreate(["descripcion" => 'Bancos'],);
        Entidad::updateOrCreate(["descripcion" => 'Cuentas'],);
        Entidad::updateOrCreate(["descripcion" => 'Rutas'],);
        Entidad::updateOrCreate(["descripcion" => 'Garantías'],);
        Entidad::updateOrCreate(["descripcion" => 'Configuraciones'],);
    }
}
