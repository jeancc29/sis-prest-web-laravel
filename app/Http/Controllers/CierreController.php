<?php

namespace App\Http\Controllers;

use App\Models\Cierre;
use App\Http\Requests\StoreCierreRequest;
use App\Http\Requests\UpdateCierreRequest;
use App\Models\Transaccion;

class CierreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fechaDesde = null;
        $fechaHasta = null;

        $usuario = auth()->user();
        if(!$usuario->tokenCan("Cajas:Ver cierres"))
            abort(401, __("mensajes.noAutorizado"));

        $cajas = $usuario->cajas;

        /***** Probar si el codigo de abajo funciona, de lo contario quitar *********/
        //Si el usuario tiene cajas pues obtenemos nuevamente esas cajas pero con sus respectivos transacciones
        //de lo contrario pues buscamos todas las cajas de la empresa y las retornamos todas pero solo la primera caja
        //va a tener sus transacciones
        if(count($cajas) > 0){
            $cajaIds = $cajas->map(function($d){
                $d->id;
            });
            $cajas = Box::customAll($cajaIds);
        }else{
            $cajas = Box::where("descripcion", '!=', "Ninguna")->where("compania_id", $datos["compania_id"])->get();
            if(count($cajas) > 0){
                $cajas[0]->transacciones = Box::transacciones($cajas[0]->id);
                $cajas[0]->cierres = Box::cierres($cajas[0]->id);
            }
        }
        /***** END Probar si el codigo de abajo funciona, de lo contario quitar *********/

        $transacciones = TransactionResource::collection(Transaccion::whereEstado(1)
            ->with("box", "type", "user", "incomeOrExpenseType")
            ->when($cajaId != null, function($q) use($cajaId){ $q->where("caja_id", $cajaId); })
            ->orderBy("created_at", "desc")
            ->get());

        $cierres = ClosureResource::collection(Cierre::whereEstado(1)
            ->with("box", "user")
            ->when($cajaId != null, function($q) use($cajaId){ $q->where("caja_id", $cajaId); })
            ->orderBy("created_at", "desc")
            ->get());

//        $cierres = Closure::


        return Response::json([
            "mensaje" => "",
            "cajas" => $cajas,
            "transacciones" => $transacciones,
            "cierres" => $cierres,
            "balance" => $transacciones->sum(function($d){return $d->incomeOrExpenseType->descripcion == "Egresos" ? -1 * $d->monto : $d->monto;})
//            "balance" => $transacciones->sum("monto")
        ], 201);
    }

    public function search(){

        $usuario = auth()->user();
        if(!$usuario->tokenCan("Cajas:Ver cierres"))
            abort(401, __("mensajes.noAutorizado"));

        $requestData = request()->validate([
            'caja_id' => 'nullable',
            'fechaDesde' => 'nullable|date',
            '$fechaHasta' => 'nullable|date',
        ]);

        $cajaId = $requestData["caja_id"] ?? null;
        $fechaDesde = $requestData["fechaDesde"] ?? null;
        $fechaHasta = $requestData["fechaHasta"] ?? null;



        $transacciones = TransactionResource::collection(Transaccion::whereStatus(1)
            ->with("caja", "tipo", "user", "tipoIngresoEgreso")
            ->when($cajaId != null, function($q) use($cajaId){ $q->whereCajaId($cajaId); })
            ->when($fechaDesde != null, function($q) use($fechaDesde, $fechaHasta){$q->whereBetween("created_at", [$fechaDesde->toDateString() . " 00:00", $fechaHasta->toDateString() . " 23:59:59"]);})
            ->orderBy("created_at", "desc")
            ->get());

        $cierres = ClosureResource::collection(Closure::whereStatus(1)
            ->with("box", "user")
            ->when($cajaId != null, function($q) use($cajaId){ $q->where("caja_id", $cajaId); })
            ->when($fechaDesde != null, function($q) use($fechaDesde, $fechaHasta){$q->whereBetween("created_at", [$fechaDesde->toDateString() . " 00:00", $fechaHasta->toDateString() . " 23:59:59"]);})
            ->orderBy("created_at", "desc")
            ->get());
    }

    public function getBoxDataToClose(){
        $datos = request()->validate([
            'data.id' => '',
            'data.usuario' => '',
            'data.apiKey' => '',
            'data.compania_id' => '',
            'data.caja_id' => '',
        ])["data"];

        \App\Classes\Helper::validateApiKey($datos["apiKey"]);
        \App\Classes\Helper::validatePermissions($datos, "Cajas", ["Ver cierres"]);

        $cajaId = $datos["caja_id"] ?? null;
        $caja = $cajaId != null ? Box::query()->find($cajaId) : null;

        $transacciones = Transaction::query()
            ->selectRaw("t.id, t.descripcion, sum(transactions.monto) total, transactions.tipo_id_ingreso_egreso")
            ->join("types as t", "t.id", "=", "transactions.tipo_id_pago")
            ->where(["transactions.caja_id" => $cajaId, "transactions.status" => 1])
            ->groupBy("transactions.tipo_id_ingreso_egreso", "t.id")
            ->orderBy("transactions.tipo_id_ingreso_egreso")
            ->orderBy("t.id")
            ->get();



        // Buscamos el index EFECTIVO


        $tiposIngresosYEgresos = Type::query()
            ->whereRenglon("contabilidad")
            ->orderBy("id")->get();

        $tiposIngresosEgresosConSusTransacciones = $tiposIngresosYEgresos->map(function($d) use($transacciones){
            $ingresosYEgresos = $transacciones->filter(function($f) use($d){return $f->tipo_id_ingreso_egreso == $d->id;})->values();

            //Como el EFECTIVO y el EFECTIVO EN RUTA son lo mismo, pues le vamos a sumar el total de EFECTIVO EN RUTA al EFECTIVO
            // y eliminaremos el EFECTIVO EN RUTA

            // Objeto efectivo en ruta
            $tipoEfectivoEnRuta = $ingresosYEgresos->first(function($item){ return $item->descripcion == "Efectivo en ruta"; });
            $isnull = $tipoEfectivoEnRuta == null;
//            $stringTipos = $ingresosYEgresos->map(function($t){ return $t->descripcion . ", "; });
//            if($d->descripcion == "Egresos")
//                throw new \Exception("Hey is null $stringTipos: " . $isnull);
            if($tipoEfectivoEnRuta != null){
                $indexTipoEfectivo = $ingresosYEgresos->search(function($item) {
                    return $item->descripcion == "Efectivo";
                });



                if(is_numeric($indexTipoEfectivo)){
//                    throw new \Exception("Hey is null: " . $indexTipoEfectivo);
                    // Sumamos el total al EFECTIVO
                    $ingresosYEgresos[$indexTipoEfectivo]->total += $tipoEfectivoEnRuta->total;

                    // eliminaremos el EFECTIVO EN RUTA
                    $indexTipoEfectivoEnRuta = $ingresosYEgresos->search(function($item) {
                        return $item->descripcion == "Efectivo en ruta";
                    });
                    $ingresosYEgresos->forget($indexTipoEfectivoEnRuta);
                }
            }



            $total = $ingresosYEgresos->sum("total");
            return ["id" => $d->id, "descripcion" => $d->descripcion, "tiposPagos" => $ingresosYEgresos, "total" => $total];
        })->values();

        return Response::json([
            "mensaje" => "",
            "tiposIngresosEgresosConSusTransacciones" => $tiposIngresosEgresosConSusTransacciones,
            "caja" => $caja
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCierreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCierreRequest $request)
    {
        $datos = request()->validate([
            'data.usuario' => '',
            'data.caja' => '',
            'data.montoEfectivo' => '',
            'data.montoCheques' => '',
            'data.montoTarjetas' => '',
            'data.montoTransferencias' => '',
            'data.comentario' => '',
        ])["data"];

        /// VALIDATE apiKEY AND permissions
        \App\Classes\Helper::validateApiKey($datos["usuario"]["apiKey"]);
        \App\Classes\Helper::validatePermissions($datos["usuario"], "Cajas", ["Realizar cierres"]);

        /// VALIDATE BOX
        $caja = Box::whereId($datos["caja"]["id"])->first();
        if($caja == null)
            abort(404, "La caja no existe");

        if($caja->balance == null)
            abort(404, "La caja no ha sido abierta");

        //VALIDATE TRANSACTIONS
        $transaccionesSinCerrar = $caja->transactions()->whereStatus(1)->get();
        if(count($transaccionesSinCerrar) == 0)
            abort(404, "La caja no tiene transacciones");

        $totalPagado = round($datos["montoEfectivo"] + $datos["montoCheques"] + $datos["montoTransferencias"], 2);

        /// CREATE CLOSURE AND SAVE HIS TRANSACTIONS
        $cierre = \App\Closure::create([
            "user_id" => $datos["usuario"]["id"],
            "compania_id" => $datos["usuario"]["compania_id"],
            "caja_id" => $caja->id,
            "totalSegunUsuario" => $totalPagado,
            "totalSegunSistema" => $caja->balance,
            "comentario" => $datos["comentario"],
            "montoEfectivo" => $datos["montoEfectivo"],
            "montoCheques" => $datos["montoCheques"],
            "montoTarjetas" => 0,
            "montoTransferencias" => $datos["montoTransferencias"],
            "diferencia" => round($totalPagado - $caja->balance, 2),
        ]);


        $transaccionesToSave = $transaccionesSinCerrar->map(function($d) use($cierre){
            return ["transaccion_id" => $d->id, "cierre_id" => $cierre->id];
        });
        $cierre->transactions()->attach($transaccionesToSave);

        ///CHANGE STATUS OF TRANSACTIONS TO CERRADA
        $caja->transactions()->whereStatus(1)->update(["status" => 2]);

        /// MAKE AUTOMATIC TRANSACTIONS Balance Inciial
//        $tipo = \App\Type::where(["renglon" => "transaccion", "descripcion" => "Balance inicial"])->first();
//        \App\Transaction::make($datos["usuario"], $caja, $caja->balanceInicial, $tipo, $caja->id, $datos["comentario"]);

        //SET NEW BALANCE TO BOX
        $caja->balance = null;
        $caja->balanceInicial = null;
        $caja->save();
        $cierre->usuario = $datos["usuario"];
        $caja->fresh();

        return Response::json([
            "message" => "La caja se ha cerrado correctamente",
            "transacciones" => Box::transacciones($caja->id),
            "data" => $cierre,
            "caja" => $caja
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function show(Cierre $cierre)
    {
        $datos = request()->validate([
            'data.usuario' => '',
            'data.cierre' => '',
        ])["data"];

        /// VALIDATE apiKEY AND permissions
        \App\Classes\Helper::validateApiKey($datos["usuario"]["apiKey"]);
        \App\Classes\Helper::validatePermissions($datos["usuario"], "Cajas", ["Ver cierres"]);

        return Response::json([
            "message" => "La caja se ha cerrado correctamente",
            "transacciones" => \App\Closure::transacciones($datos["cierre"]["id"]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function edit(Cierre $cierre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCierreRequest  $request
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCierreRequest $request, Cierre $cierre)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cierre $cierre)
    {
        //
    }
}
