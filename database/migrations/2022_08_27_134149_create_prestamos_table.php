<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->decimal("monto", 20, 2);
            $table->double("porcentajeInteres", 10, 2);
            $table->double("porcentajeInteresAnual", 10, 2);
            $table->decimal("montoInteres", 20, 2)->default(0);
            $table->integer("numeroCuotas");
            $table->date("fecha");
            $table->date("fechaPrimerPago");
            $table->string("codigo")->nullable();
            $table->double("porcentajeMora", 5, 2);
            $table->integer("diasGracia")->default(0);
            $table->decimal("capitalTotal", 20, 2)->default(0);
            $table->decimal("interesTotal", 20, 2)->default(0);
            $table->decimal("capitalPendiente", 20, 2)->default(0);
            $table->decimal("interesPendiente", 20, 2)->default(0);
            $table->decimal("mora", 20, 2)->default(0);
            $table->decimal("cuota", 20, 2)->default(0);
            $table->integer("numeroCuotasPagadas")->default(0);
            $table->integer("cuotasAtrasadas")->default(0);
            $table->integer("diasAtrasados")->default(0);
            $table->integer("estado")->default(1);
            $table->date("fechaProximoPago")->nullable();
            $table->foreignId("compania_id")->type("integer")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("cliente_id")->constrained();
            $table->foreignId("tipo_id_plazo")->type("integer")->constrained();
            $table->foreignId("tipo_id_amortizacion")->type("integer")->constrained();
            $table->foreignId("caja_id")->constrained();
            $table->foreignId("user_id_cobrador")->constrained();
            $table->foreignId("ruta_id")->constrained();
            // $table->unsignedInteger("idGasto");
            $table->foreignId("desembolso_id")->constrained();
            $table->foreignId("moneda_id")->type("integer")->constrained();
            //la llave foranea del user_id se agregara despues de crear la tabla usuario
            $table->softDeletes();
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
        Schema::dropIfExists('prestamos');
    }
}
