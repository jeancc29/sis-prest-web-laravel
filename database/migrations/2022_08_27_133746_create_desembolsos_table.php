<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesembolsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desembolsos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tipo_id")->type("integer")->constrained();
            $table->foreignId("banco_id")->type("integer")->nullable()->constrained();
            $table->foreignId("cuenta_id")->type("integer")->nullable()->constrained();
            $table->string("numeroCheque")->nullable();
            $table->foreignId("banco_id_destino")->type("integer")->constrained();
            $table->string("cuentaDestino")->nullable();
            $table->double("montoBruto", 20, 2);
            $table->double("montoNeto", 20, 2);
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
        Schema::dropIfExists('desembolsos');
    }
}
