<?php

namespace Database\Seeders;

use App\Models\Entidad;
use App\Models\Permiso;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entidad = Entidad::whereDescripcion("Dashboard")->first();
        Permiso::updateOrCreate(["descripcion" => 'Dashboard', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Clientes")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Prestamos")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "entidad_id" => $entidad->id],);
        // Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Pagos")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Cambiar fecha', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Cambiar caja', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Modificar mora', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Descuento', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Cajas")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Abrir', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Crear', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Actualizar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Ver cierres', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Realizar cierres', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Realizar ajustes', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Hacer transferencias', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Bancos")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Crear', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Actualizar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Cuentas")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Crear', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Actualizar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Rutas")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Guardar', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Eliminar', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Configuraciones")->first();
        Permiso::updateOrCreate(["descripcion" => 'Empresa', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Prestamo', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Recibo', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Otros', "entidad_id" => $entidad->id],);

        $entidad = Entidad::whereDescripcion("Garantías")->first();
        Permiso::updateOrCreate(["descripcion" => 'Ver', "entidad_id" => $entidad->id],);
        Permiso::updateOrCreate(["descripcion" => 'Cambiar estado', "entidad_id" => $entidad->id],);
    }
}
