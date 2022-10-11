<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionPrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion_prestamos', function (Blueprint $table) {
            $table->increments("id");
            $table->boolean("gasto")->default(0);
            $table->boolean("garantia")->default(0);
            $table->boolean("desembolso")->default(0);
            $table->foreignId("compania_id")->type("integer")->constrained();
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
        Schema::dropIfExists('configuracion_prestamos');
    }
}
