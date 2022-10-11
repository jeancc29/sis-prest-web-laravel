<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->string("concepto");
            $table->double("monto", 20);
            $table->text("comentario")->nullable();
//            $table->unsignedBigInteger("caja_id")->nullable();
//            $table->unsignedInteger("tipo_id"); //Tipo categoria
//            $table->unsignedInteger("tipo_id_pago"); //Tipo categoria
//            $table->unsignedInteger("user_id");
//            $table->unsignedInteger("compania_id");
            $table->foreignId("caja_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("tipo_id")->type("integer")->constrained();
            $table->foreignId("tipo_id_pago")->type("integer")->constrained();
            $table->foreignId("compania_id")->type("integer")->constrained();
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
        Schema::dropIfExists('gastos');
    }
}
