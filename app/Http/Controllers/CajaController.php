<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Http\Requests\CajaStoreUpdateRequest;
use App\Models\Caja;
use App\Http\Requests\StoreCajaRequest;
use App\Http\Requests\UpdateCajaRequest;
use App\Models\Tipo;
use App\Models\Transaccion;
use Illuminate\Support\Facades\App;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //App::setLocale("es");
        //$locale = App::currentLocale()
        //App::isLocale('en')
        if(!auth()->user()->tokenCan("Cajas:Ver"))
            abort(401, __("mensajes.noAutorizado"));

        return response([
            "cajas" => Caja::get(),
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
     * @param  \App\Http\Requests\StoreCajaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CajaStoreUpdateRequest $request)
    {
        if(!auth()->user()->tokenCan("Cajas:Crear"))
            abort(401, __("errores.noAutorizado"));

        $caja = Caja::create($request->validated());

        return response([
            "mensaje" => __("mensajes.guardado"),
            "caja" => $caja
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function show(Caja $caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCajaRequest  $request
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function update(CajaStoreUpdateRequest $request, Caja $caja)
    {
        if(!auth()->user()->tokenCan("Cajas:Actualizar"))
            abort(401, __("errores.noAutorizado"));

        $data = $request->validated();

        $caja->descripcion = $data["descripcion"];
        $caja->save();

        return response([
            "mensaje" => __("mensajes.guardado"),
            "caja" => $caja
        ]);
    }

    /**
     * Le asigna un balance inicial a la caja.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function abrir(Caja $caja)
    {
        $usuario = auth()->user();
        if(!$usuario->tokenCan("Cajas:Actualizar"))
            abort(401, __("errores.noAutorizado"));

        $data = request()->validate([
            "balanceInicial" => "required|numeric",
            "comentario" => "nullable|string",
        ]);

        $balanceInicial = $data["balanceInicial"];
        $comentario = $data["comentario"];

        $caja->balanceInicial = $balanceInicial;
        $caja->save();

        $tipo = Tipo::where(["renglon" => "transaccion", "descripcion" => "Balance inicial"])->first();
        $tipo = Helper::stdClassToArray($tipo);
        Transaccion::make($usuario, $caja, $data["balanceInicial"], $tipo, Caja::class, $caja->id, $data["comentario"]);

        $caja->descripcion = $comentario;
        $caja->save();

        return response([
            "mensaje" => __("mensajes.guardado"),
            "caja" => $caja
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caja $caja)
    {
        if(!auth()->user()->tokenCan("Cajas:Eliminar"))
            abort(401, __("errores.noAutorizado"));

        $caja->delete();

        return response([
            "mensaje" => __("mensajes.eliminado"),
            "caja" => $caja
        ]);
    }
}
