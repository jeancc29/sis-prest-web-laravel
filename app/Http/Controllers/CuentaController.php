<?php

namespace App\Http\Controllers;

use App\Http\Requests\CuentaRequest;
use App\Http\Resources\CuentaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Cuenta;
use App\Models\Banco;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $requestData = request()->validate([
//            'data.id' => '',
//            'data.nombres' => '',
//            'data.usuario' => '',
//            'data.apiKey' => '',
//            'data.idEmpresa' => '',
//            'data.idCuenta' => '',
//            'data.idBanco' => '',
//            'data.retornarBancos' => '',
//            'data.retornarCuentas' => '',
//        ])["data"];

//        \App\Classes\Helper::validateApiKey($requestData["apiKey"]);
//        \App\Classes\Helper::validatePermissions($requestData, "Cuentas", ["Ver"]);

        $usuario = auth()->user();
        if(!$usuario->tokenCan("Cuentas:Ver"))
            abort(401, __("mensajes.noAutorizado"));

        $requestData = request()->validate([
            'id' => '',
            'retornarBancos' => '',
            'retornarCuentas' => '',
            'idBanco' => '',
            'idCuenta' => '',
        ]);

        $id = $requestData["idCuenta"] ?? null;
        $idBanco = $requestData["idBanco"] ?? null;
        $retornarBancos = $requestData["retornarBancos"] ?? false;
        $retornarCuentas = $requestData["retornarCuentas"] ?? true;

        $data = null;
        $bancos = [];

        if($id != null) {
            $data = Cuenta::query()->where(["id" => $id])->first();
            if($data == null)
                throw new \Exception("La cuenta no existe");
        }

        if($retornarBancos){
            $bancos = Banco::query()->where(["estado" => 1])->take(50)->get();
            if($bancos->count() == 0)
                throw new \Exception("No se puenden crear cuentas sin bancos registrados, debe registrar al menos un banco");
        }

//        $data ??= new CuentaResource($data);

        return
            \response([
            "mensaje" => "",
            "cuentas" => $retornarCuentas ? CuentaResource::collection(Cuenta::when($idBanco != null, function($q) use($idBanco){$q->where("idBanco", $idBanco);})->take(20)->get()) : [],
            "bancos" => $bancos,
            "data" => $data != null ? new CuentaResource($data) : null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->tokenCan("Cuentas:Guardar"))
            abort(401, __("mensajes.noAutorizado"));

        $bancos = Banco::query()->where(["estado" => 1])->take(50)->get(["id", "descripcion"]);

        return \response(["bancos" => $bancos,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuentaRequest $request)
    {
        if(!auth()->user()->tokenCan("Cuentas:Crear"))
            abort(401, __("mensajes.noAutorizado"));

        $cuenta = Cuenta::create($request->validated());

        return \response([
            "mensaje" => __("mensajes.guardado"),
            "cuenta" => new CuentaResource($cuenta)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        return \response([
            "mensaje" => "",
            "bancos" => $cuenta
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        if(!auth()->user()->tokenCan("Cuentas:Actualizar"))
            abort(401, __("mensajes.noAutorizado"));

        $bancos = Banco::query()->where(["estado" => 1])->take(50)->get(["id", "descripcion"]);

        return \response(["bancos" => $bancos, "cuenta" => $cuenta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(CuentaRequest $request, Cuenta $cuenta)
    {
        if(!auth()->user()->tokenCan("Cuentas:Actualizar"))
            abort(401, __("mensajes.noAutorizado"));

        $data = $request->validated();

        $cuenta->descripcion = $data["descripcion"];
        $cuenta->banco_id = $data["banco_id"];
        $cuenta->save();

        return \response([
            "mensaje" => __("mensajes.guardado"),
            "cuenta" => new CuentaResource($cuenta)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        if(!auth()->user()->tokenCan("Cuentas:Eliminar"))
            abort(401, __("mensajes.noAutorizado"));

        $cuenta->delete();

        return \response([
            "mensaje" => __("mensajes.eliminado"),
            "cuenta" => $cuenta
        ]);
    }
}
