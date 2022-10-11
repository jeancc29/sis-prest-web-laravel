<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionPrestamo;
use App\Http\Requests\StoreConfiguracionPrestamoRequest;
use App\Http\Requests\UpdateConfiguracionPrestamoRequest;

class ConfiguracionPrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreConfiguracionPrestamoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConfiguracionPrestamoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConfiguracionPrestamo  $configuracionPrestamo
     * @return \Illuminate\Http\Response
     */
    public function show(ConfiguracionPrestamo $configuracionPrestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConfiguracionPrestamo  $configuracionPrestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfiguracionPrestamo $configuracionPrestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConfiguracionPrestamoRequest  $request
     * @param  \App\Models\ConfiguracionPrestamo  $configuracionPrestamo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfiguracionPrestamoRequest $request, ConfiguracionPrestamo $configuracionPrestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConfiguracionPrestamo  $configuracionPrestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfiguracionPrestamo $configuracionPrestamo)
    {
        //
    }
}
