<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::updateOrCreate(["descripcion" => "Hombre"], ["categoria" => "sexo"]);
        Tipo::updateOrCreate(["descripcion" => "Mujer"], ["categoria" => "sexo"]);
        Tipo::updateOrCreate(["descripcion" => "Otro..."], ["categoria" => "sexo"]);

        Tipo::updateOrCreate(["descripcion" => "Soltero"], ["categoria" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Casado"], ["categoria" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Unión libre"], ["categoria" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Divorciado"], ["categoria" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Viudo"], ["categoria" => "estadoCivil"]);

        Tipo::updateOrCreate(["descripcion" => "Propia"], ["categoria" => "vivienda"]);
        Tipo::updateOrCreate(["descripcion" => "Alquilada"], ["categoria" => "vivienda"]);
        Tipo::updateOrCreate(["descripcion" => "Pagando"], ["categoria" => "vivienda"]);

        Tipo::updateOrCreate(["descripcion" => "Cédula identidad"], ["categoria" => "documento"]);
        Tipo::updateOrCreate(["descripcion" => "RNC"], ["categoria" => "documento"]);
        Tipo::updateOrCreate(["descripcion" => "Pasaporte"], ["categoria" => "documento"]);

        Tipo::updateOrCreate(["descripcion" => "Ninguna"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Combustible"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Gastos Diversos"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Nómina"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Comisión Agente"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Aportaciones"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Automóvil"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Renta"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Sistema"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Pagina Web"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Imprestos"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Seguro Social"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Comisiones Bancarias"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Misceláneo"], ["categoria" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Almuerzo Administrativo"], ["categoria" => "gasto"]);

        Tipo::updateOrCreate(["descripcion" => "Cuota fija"], ["categoria" => "amortizacion"]);
        Tipo::updateOrCreate(["descripcion" => "Disminuir cuota"], ["categoria" => "amortizacion"]);
        Tipo::updateOrCreate(["descripcion" => "Interes fijo"], ["categoria" => "amortizacion"]);
        Tipo::updateOrCreate(["descripcion" => "Capital al final"], ["categoria" => "amortizacion"]);

        Tipo::updateOrCreate(["descripcion" => "Diario"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Semanal"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Bisemanal"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Quincenal"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "15 y fin de mes"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Mensual"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Anual"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Semestral"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Trimestral"], ["categoria" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Ult. dia del mes"], ["categoria" => "plazo"]);

        Tipo::updateOrCreate(["descripcion" => "Gastos de cierre"], ["categoria" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Tasacion"], ["categoria" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Cargos por seguro"], ["categoria" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Otros gastos de cierre"], ["categoria" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Gastos del gps"], ["categoria" => "gastoPrestamo"]);

        Tipo::updateOrCreate(["descripcion" => "Efectivo"], ["categoria" => "desembolso"]);
        Tipo::updateOrCreate(["descripcion" => "Cheque"], ["categoria" => "desembolso"]);
        Tipo::updateOrCreate(["descripcion" => "Transferencia"], ["categoria" => "desembolso"]);
        Tipo::updateOrCreate(["descripcion" => "Efectivo en ruta"], ["categoria" => "desembolso"]);

        Tipo::updateOrCreate(["descripcion" => "Vehiculo"], ["categoria" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Infraestructura"], ["categoria" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Joyeria"], ["categoria" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Electrodomestico"], ["categoria" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Inmueble"], ["categoria" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Telefono"], ["categoria" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Otros"], ["categoria" => "garantia"]);

        Tipo::updateOrCreate(["descripcion" => "Nuevo"], ["categoria" => "condicionGarantia"]);
        Tipo::updateOrCreate(["descripcion" => "Usado"], ["categoria" => "condicionGarantia"]);

        Tipo::updateOrCreate(["descripcion" => "Sedan"], ["categoria" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Compacto"], ["categoria" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Jeepeta"], ["categoria" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Camioneta"], ["categoria" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Coupe/Sport"], ["categoria" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Camion"], ["categoria" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Motor"], ["categoria" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Otros"], ["categoria" => "tipoVehiculo"]);

        Tipo::updateOrCreate(["descripcion" => "Capital pendiente"], ["categoria" => "mora"]);
        Tipo::updateOrCreate(["descripcion" => "Cuota vencida"], ["categoria" => "mora"]);
        Tipo::updateOrCreate(["descripcion" => "Capital vencido"], ["categoria" => "mora"]);

        Tipo::updateOrCreate(["descripcion" => "Balance inicial"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Pago"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Anulación pago"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Préstamo"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Cancelación préstamo"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Ajuste capital"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Anulación ajuste capital"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Ajuste caja"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Gasto"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Anulación caja"], ["categoria" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Transferencia entre cajas"], ["categoria" => "transaccion"]);

        Tipo::updateOrCreate(["descripcion" => "Empleado"], ["categoria" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Desempleado"], ["categoria" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Estudiante"], ["categoria" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Independiente"], ["categoria" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Negocio propio"], ["categoria" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Pensionado"], ["categoria" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Otros"], ["categoria" => "situacionLaboral"]);

        Tipo::updateOrCreate(["descripcion" => "Disminuir valor cuota"], ["categoria" => "abonoCapital"]);
        Tipo::updateOrCreate(["descripcion" => "Disminuir plazo"], ["categoria" => "abonoCapital"]);

        Tipo::updateOrCreate(["descripcion" => "Ingresos"], ["categoria" => "contabilidad"]);
        Tipo::updateOrCreate(["descripcion" => "Egresos"], ["categoria" => "contabilidad"]);
    }
}
