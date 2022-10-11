<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion_recibos', function (Blueprint $table) {
            $table->foreignId("compania_id")->type("integer")->constrained();
            $table->boolean("copia");
            $table->boolean("capital");
            $table->boolean("mora");
            $table->boolean("interes");
            $table->boolean("descuento");
            $table->boolean("capitalPendiente");
            $table->boolean("balancePendiente");
            $table->boolean("fechaProximoPago");
            $table->boolean("formaPago");
            $table->boolean("firma");
            $table->boolean("mostrarCentavosRecibidos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracion_recibos');
    }
}
