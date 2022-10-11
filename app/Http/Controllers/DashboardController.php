<?php

namespace App\Http\Controllers;

use App\Enums\MesesSegunFuncionMonthDeMysql;
use App\Models\Cliente;
use App\Models\DetallePago;
use App\Models\Gasto;
use App\Models\Pago;
use App\Models\Prestamo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index(){

        if(!auth()->user()->tokenCan("Dashboard:Dashboard"))
            abort(401, __("errores.noAutorizado"));

        $datos = request()->validate([
            'fechaDesde' => 'nullable|date',
            'fechaHasta' => 'nullable|date',
        ]);

        $fechaDesde = $datos["fechaDesde"] != null ? new Carbon($datos["fechaDesde"]) : now();
        $fechaHasta = $datos["fechaHasta"] != null ? new Carbon($datos["fechaHasta"]) : now();

        $queryFechaPrestamo = "";
        $queryFechaPagos = "";
        $queryFechaGasto = "";
//        if(isset($datos["fechaDesde"]) && isset($datos["fechaDesde"]) ){
//            $queryFechaPrestamo = "AND loans.fecha BETWEEN {$datos['fechaDesde']} AND {$datos['fechaHasta']}";
//            $queryFechaPagos = "AND p.fecha BETWEEN {$datos['fechaDesde']} AND {$datos['fechaHasta']}";
//            $queryFechaGasto = "WHERE expenses.fecha BETWEEN {$datos['fechaDesde']} AND {$datos['fechaHasta']}";
//        }

        $cantidadDeClientes = Cliente::query()->count();

        $cantidadDePrestamosTotalPrestadoTotalInteres = Prestamo::query()
            ->selectRaw("count(id) as cantidad, sum(monto) totalPrestado, sum(montoInteres) totalInteres")
            ->when($fechaDesde != null && $fechaHasta != null, fn($q) => $q->whereBetween("fecha", [$fechaDesde->toDateString(), $fechaHasta->toDateString()]))
            ->whereIn("estado", [1, 2])
            ->get();

        $cantidadDePrestamos = $cantidadDePrestamosTotalPrestadoTotalInteres[0]->cantidad;
        $totalPrestado = $cantidadDePrestamosTotalPrestadoTotalInteres[0]->totalPrestado;
        $totalInteres = $cantidadDePrestamosTotalPrestadoTotalInteres[0]->totalInteres;
        $totalGastos = Gasto::query()
            ->when($fechaDesde != null && $fechaHasta != null, fn($q) => $q->whereBetween("created_at", [$fechaDesde->toDateString() . " 00:00", $fechaHasta->toDateString() . " 23:59:59"]))
            ->sum("monto");
        $totalEgresos = $totalGastos + $totalPrestado;

        $ingresosPorMesesEnCeroAgrupadosPorCapitalInteresYMora = $this->ingresosPorMesesEnCeroAgrupadosPorCapitalInteresYMora();
        $pagosAgrupadosPorMes = Pago::query()
            ->selectRaw('MONTH(pagos.fecha) mes, sum(detalle_pagos.capital) capital, sum(detalle_pagos.interes) interes, sum(detalle_pagos.mora) mora')
            ->join('detalle_pagos', 'detalle_pagos.pago_id', '=', 'pagos.id')
            ->where("pagos.estado", 1)
            ->groupByRaw('MONTH(pagos.fecha)')
            ->get();

        $sustituirIngresosPorMesesEnCerosPorPagosMayoresQueCeroCorrespondienteACadaMes = $ingresosPorMesesEnCeroAgrupadosPorCapitalInteresYMora->map(function ($ingresoMesEnCero) use($pagosAgrupadosPorMes){
            $pagoBuscadoPorMes = $pagosAgrupadosPorMes->first(fn($pago) => $ingresoMesEnCero["mes"] == $pago->mes);
            return $pagoBuscadoPorMes != null ? $pagoBuscadoPorMes->toArray() :  $ingresoMesEnCero;
        });

        $ingresosPorMes = $sustituirIngresosPorMesesEnCerosPorPagosMayoresQueCeroCorrespondienteACadaMes;

        $totalIngresos = Pago::query()
            ->where("estado", 1)
            ->whereBetween("created_at", [$fechaDesde->toDateString() . " 00:00", $fechaHasta->toDateString() . " 23:59:59"])
            ->sum("monto");

        $totalMora = Pago::query()
            ->join('detalle_pagos', 'detalle_pagos.pago_id', '=', 'pagos.id')
            ->where("pagos.estado", 1)
            ->sum("detalle_pagos.mora");


//        $data = \DB::select("
//            SELECT
//                (SELECT COUNT(customers.id) FROM customers WHERE customers.estado = 1 AND customers.idEmpresa = {$datos['usuario']['idEmpresa']}) AS cantidadClientes,
//                (SELECT COUNT(loans.id) FROM loans WHERE loans.status in (1, 2) AND loans.idEmpresa = {$datos['usuario']['idEmpresa']}) AS cantidadPrestamos,
//                (SELECT SUM(loans.monto) FROM loans WHERE loans.status in (1, 2) AND loans.idEmpresa = {$datos['usuario']['idEmpresa']} $queryFechaPrestamo) AS totalPrestado,
//                (SELECT SUM(loans.montoInteres) FROM loans WHERE loans.status in (1, 2) AND loans.idEmpresa = {$datos['usuario']['idEmpresa']} $queryFechaPrestamo) AS totalInteres,
//                (
//                    SELECT
//                    JSON_ARRAYAGG(
//                            JSON_OBJECT(
//                                'capital', pay.capital,
//                                'interes', pay.interes,
//                                'mora', pay.mora,
//                                'mes', mes.mes,
//                                'fecha', pay.mes
//                            )
//                        )
//
//                    FROM    (
//                            SELECT
//                                SUM(pd.capital) AS capital,
//                                SUM(pd.interes) AS interes,
//                                SUM(pd.mora) AS mora,
//                                MONTH(p.fecha) AS mes
//                            FROM paydetails AS pd
//                            INNER JOIN pays AS p on p.id = pd.idPago
//                            WHERE
//                                p.status = 1
//                                AND p.idEmpresa = {$datos['usuario']['idEmpresa']}
//                                $queryFechaPagos
//
//                            GROUP BY MONTH(p.fecha)
//                        ) AS pay
//                        RIGHT JOIN(
//                            select 1 as mes UNION
//                            select 2 as mes UNION
//                            select 3 as mes UNION
//                            select 4 as mes UNION
//                            select 5 as mes UNION
//                            select 6 as mes UNION
//                            select 7 as mes UNION
//                            select 8 as mes UNION
//                            select 9 as mes UNION
//                            select 10 as mes UNION
//                            select 11 as mes UNION
//                            select 12 as mes
//                        ) AS mes ON mes.mes = pay.mes
//                ) as ingresospormeses,
//                (
//                    SELECT
//                        SUM(egresos.montoTotal)
//                    FROM (
//                        SELECT SUM(loans.monto) montoTotal FROM loans WHERE loans.status in(1, 2) $queryFechaPrestamo
//                        UNION
//                        SELECT SUM(expenses.monto) montoTotal FROM expenses $queryFechaGasto
//                    ) egresos
//                ) AS totalEgresos,
//                (
//                    SELECT SUM(pays.monto) FROM pays WHERE pays.status = 1 $queryFechaPagos
//                ) AS totalIngresos,
//                (SELECT SUM(paydetails.mora) FROM paydetails WHERE paydetails.idPago in(SELECT pays.id FROM pays WHERE pays.status = 1)) AS totalMora
//        ");

        return response([
            "mensaje" => "",
//            "data" => count($data) > 0 ? $data[0] : null,
            "cantidadDeClientes" => $cantidadDeClientes,
            "cantidadDePrestamos" => $cantidadDePrestamos,
            "totalPrestado" => $totalPrestado,
            "totalInteres" => $totalInteres,
            "totalGastos" => $totalGastos,
            "totalEgresos" => $totalEgresos,
            "ingresosPorMes" => $ingresosPorMes,
            "totalIngresos" => $totalIngresos,
            "totalMora" => $totalMora,
        ]);
    }

    private function ingresosPorMesesEnCeroAgrupadosPorCapitalInteresYMora() : Collection{
        return collect([
            ["mes" => MesesSegunFuncionMonthDeMysql::Enero->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Febrero->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Marzo->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Abril->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Mayo->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Junio->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Julio->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Agosto->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Septiembre->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Octubre->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Noviembre->value, "capital" => 0, "interes" => 0, "mora" => 0],
            ["mes" => MesesSegunFuncionMonthDeMysql::Diciembre->value, "capital" => 0, "interes" => 0, "mora" => 0],
        ]);
    }
}
