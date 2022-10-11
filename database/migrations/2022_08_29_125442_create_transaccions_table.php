<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("compania_id")->type("integer")->constrained();
            $table->foreignId("caja_id")->constrained();
            $table->decimal("monto", 20, 2);
            $table->string("comentario")->nullable();
            $table->integer("estado")->default(1);
            $table->foreignId("tipo_id")->type("integer")->constrained();
            $table->foreignId("tipo_id_pago")->nullable()->type("integer")->constrained();
//            $table->unsignedBigInteger("idReferencia")->nullable();
            $table->unsignedBigInteger("transaccionable_id");
            $table->string("transaccionable_type");
            $table->foreignId("tipo_id_ingreso_egreso")->nullable()->type("integer")->constrained();
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
        Schema::dropIfExists('transaccions');
    }
}
