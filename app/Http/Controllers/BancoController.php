<?php

namespace App\Http\Controllers;

use App\Http\Requests\BancoRequest;
use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user();
        if(!$usuario->tokenCan("Bancos:Ver"))
            abort(401, __("mensajes.noAutorizado"));

        return \response([
            "bancos" => Banco::take(20)->get(["id", "descripcion"]),
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BancoRequest $request)
    {

        if(!auth()->user()->tokenCan("Bancos:Crear"))
            abort(401, __("mensajes.noAutorizado"));

        $banco = Banco::create($request->validated());

        return \response([
            "mensaje" => __("mensajes.guardado"),
            "banco" => $banco
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
        if(!auth()->user()->tokenCan("Bancos:Actualizar"))
            abort(401, __("mensajes.noAutorizado"));

        return \response([
            "banco" => $banco
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(BancoRequest $request, Banco $banco)
    {
        if(!auth()->user()->tokenCan("Bancos:Actualizar"))
            abort(401, __("mensajes.noAutorizado"));

        $datos = $request->validated();

        $banco->descripcion = $datos["descripcion"];
        $banco->estado = $datos["estado"];
        $banco->save();

        return \response([
            "mensaje" => __("mensajes.guardado"),
            "banco" => $banco
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banco $banco)
    {
        if(!auth()->user()->tokenCan("Bancos:Eliminar"))
            abort(401, __("mensajes.noAutorizado"));

        if($banco->cuentas()->count() > 0)
            abort(404, __("errores.bancoPerteneceAVariasCuentas"));

        $banco->delete();

        return \response([
            "mensaje" => __("mensajes.eliminado"),
            "cuenta" => $banco
        ]);
    }
}
