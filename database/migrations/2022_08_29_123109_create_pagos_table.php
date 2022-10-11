<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("cliente_id")->constrained();
            $table->foreignId("prestamo_id")->constrained();
            $table->foreignId("compania_id")->type("integer")->constrained();
            $table->foreignId("tipo_id_pago")->type("integer")->constrained();
            $table->foreignId("tipo_id_abono_a_capital")->nullable()->type("integer")->constrained();
            $table->foreignId("caja_id")->nullable()->constrained();
            $table->double("monto");
            $table->double("devuelta")->default(0);
            $table->double("descuento")->default(0);
            $table->string("comentario")->nullable();
            $table->string("concepto")->nullable();
            $table->date("fecha");
            $table->integer("estado")->default(1);
            $table->boolean("esAbonoACapital")->default(0);
            $table->boolean("esRenegociacion")->default(0);
            $table->unsignedBigInteger("renegociacion_id")->nullable();
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
        Schema::dropIfExists('pagos');
    }
}
