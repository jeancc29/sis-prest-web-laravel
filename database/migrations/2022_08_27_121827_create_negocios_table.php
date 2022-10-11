<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->nullable();
            $table->string("tipo")->nullable();
            $table->string("tiempoExistencia")->nullable();
//            $table->unsignedInteger("direccion_id")->nullable();
//            $table->unsignedInteger("moneda_id");
//            $table->unsignedInteger("nacionalidad_id");
            // $table->unsignedInteger("contacto_id");
            // $table->unsignedInteger("cliente_id");

//            $table->foreign("direccion_id")->references("id")->on("addresses");
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
        Schema::dropIfExists('negocios');
    }
}
