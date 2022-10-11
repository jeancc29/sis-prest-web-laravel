<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            //            $table->string("foto")->nullable();
//            $table->string("nombres");
//            $table->string("apellidos");
            $table->string("apodo")->nullable();
            $table->date("fechaNacimiento");
            $table->integer("numeroDependientes")->nullable();
            $table->foreignId('tipo_id_sexo')->type("integer")->nullable();
            $table->unsignedInteger('tipo_id_estado_civil')->nullable();
            $table->unsignedInteger("tipo_id_vivienda")->nullable();
            $table->string("tiempoEnVivienda")->nullable();
            $table->string("referidoPor")->nullable();
            $table->integer("estado")->default(1);
            $table->foreignId('compania_id')->type("integer");
            $table->foreignId('documento_id')->type("integer");
            $table->foreignId('nacionalidad_id')->type("integer");
            $table->foreignId('empleo_id')->type("integer");
            $table->foreignId('negocio_id')->type("integer");
            $table->foreignId('tipo_id_situacion_laboral')->nullable()->type("integer")->constrained();
            $table->foreignId('ruta_id')->type("integer");
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
        Schema::dropIfExists('clientes');
    }
}
