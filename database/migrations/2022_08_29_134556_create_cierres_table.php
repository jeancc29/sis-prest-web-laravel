<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierres', function (Blueprint $table) {
            $table->id();
            $table->foreignId("compania_id")->type("integer")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("caja_id")->constrained();
            $table->decimal("totalSegunUsuario", 20, 2);
            $table->decimal("totalSegunSistema", 20, 2);
            $table->decimal("montoEfectivo", 20, 2);
            $table->decimal("montoCheques", 20, 2)->default(0);
            $table->decimal("montoTarjetas", 20, 2)->default(0);
            $table->decimal("montoTransferencias", 20, 2)->default(0);
            $table->decimal("diferencia", 20, 2)->default(0);
            $table->string("comentario")->nullable();
            $table->integer("estado")->default(1);
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
        Schema::dropIfExists('cierres');
    }
}
