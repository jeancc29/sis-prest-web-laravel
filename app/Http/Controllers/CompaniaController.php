<?php

namespace App\Http\Controllers;

use App\Models\Compania;
use App\Http\Requests\StoreCompaniaRequest;
use App\Http\Requests\UpdateCompaniaRequest;

class CompaniaController extends Controller
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
     * @param  \App\Http\Requests\StoreCompaniaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompaniaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function show(Compania $compania)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function edit(Compania $compania)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompaniaRequest  $request
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompaniaRequest $request, Compania $compania)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compania $compania)
    {
        //
    }
}
