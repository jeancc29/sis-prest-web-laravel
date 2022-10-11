<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionOtrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion_otros', function (Blueprint $table) {
            $table->increments("id");
            $table->foreignId("compania_id")->type("integer")->constrained();
            $table->boolean("ocultarInteresAmortizacion");
            $table->boolean("requirirSeleccionarCaja");
            $table->boolean("calcularComisionACuota");
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
        Schema::dropIfExists('configuracion_otros');
    }
}
